<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PnbpUpdateRequest;
use App\Http\Requests\PnbpPaymentRequest;
use App\LogTradePermit;
use App\Percentage;
use App\Pnbp;
use App\TradePermit;
use App\TradePermitStatus;
use App\HistoryPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\VerificationPayment;

class PnbpController extends Controller
{

    public function index()
    {
        $trade_permits = TradePermit::whereHas('tradeStatus', function ($query) {
            $query->where('status_code', '200');
        })->where('is_printed', '=', 1)->orderBy('trade_permit_code', 'asc')->paginate(10);
        $percentages = Percentage::all();

        return view('admin.pnbp.index', compact('trade_permits', 'percentages'));
    }

    public function show($id)
    {
        $trade_permit   =   TradePermit::findOrFail($id);
        $pnbp_last      =   Pnbp::orderBy('pnbp_code','desc')->first();
        $id='';
        if($pnbp_last === null){
            $id = 1;
        }else{
            $id = substr($pnbp_last->pnbp_code,0,5) + 1;
        }
        $pnbp_code      =   $this->getCode($id);
        $percentages = Percentage::all();

        return view('admin.pnbp.create', compact('trade_permit', 'pnbp_code', 'percentages'));
    }

    public function store(PnbpUpdateRequest $request, $id)
    {
        $trade_permit = TradePermit::findOrFail($id);
        $desc='';

        $pnbp=new Pnbp([
            'pnbp_code'     => $request->get('pnbp_code'),
            'pnbp_amount'   => $request->get('pnbp_amount'),
            'percentage_value' => $request->get('percentage_value'),
            'pnbp_percentage_amount' => $request->get('pnbp_percentage_amount'),
            'pnbp_sub_amount'   => $request->get('pnbp_sub_amount'),
            'created_by'    => $request->user()->id,
            'updated_by'    => $request->user()->id,
        ]);
        $pnbp->save();
        $trade_permit->pnbp()->save($pnbp);

        //nambahin log
        $log=LogTradePermit::create([
            'log_description'           => 'Buat PNBP Permohonan',
            'trade_permit_code'         => $trade_permit->trade_permit_code,
            'valid_start'               => $trade_permit->valid_start,
            'valid_until'               => $trade_permit->valid_until,
            'consignee'                 => $trade_permit->consignee,
            'appendix_type'             => $trade_permit->appendix_type,
            'date_submission'           => $trade_permit->date_submission,
            'period'                    => $trade_permit->period,
            'port_exportation'          => $trade_permit->port_exportation,
            'port_destination'          => $trade_permit->port_destination,
            'trading_type_id'           => $trade_permit->trading_type_id,
            'purpose_type_id'           => $trade_permit->purpose_type_id,
            'company_id'                => $trade_permit->company_id,
            'trade_permit_status_id'    => $trade_permit->trade_permit_status_id,
            'created_by'                => $request->user()->id,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
            'stamp' => $trade_permit->stamp,
            'is_printed' => $trade_permit->is_printed
        ]);
        $trade_permit->logTrade()->save($log);

        return redirect()->route('admin.pnbp.index')->with('success', 'Data berhasil dibuat.');
    }

    public function showPayment($id)
    {
        $trade_permit   =   TradePermit::findOrFail($id);
        $percentages = Percentage::all();
        
        return view('admin.pnbp.payment', compact('trade_permit', 'percentages'));
    }

    public function storePayment(PnbpPaymentRequest $request, $id)
    {
        $trade_permit   = TradePermit::findOrFail($id);
        $status         = TradePermitStatus::where('status_code','600')->first();

        //Ganti status trade permit
        $trade_permit->tradeStatus()->associate($status)->save();

        //Log Trade Permit
        $log=LogTradePermit::create([
            'log_description'           =>'Penerbitan Permohonan dan Pelunasan PNBP',
            'trade_permit_code'         => $trade_permit->trade_permit_code,
            'valid_start'               => $trade_permit->valid_start,
            'valid_until'               => $trade_permit->valid_until,
            'consignee'                 => $trade_permit->consignee,
            'appendix_type'             => $trade_permit->appendix_type,
            'date_submission'           => $trade_permit->date_submission,
            'period'                    => $trade_permit->period,
            'port_exportation'          => $trade_permit->port_exportation,
            'port_destination'          => $trade_permit->port_destination,
            'trading_type_id'           => $trade_permit->trading_type_id,
            'purpose_type_id'           => $trade_permit->purpose_type_id,
            'company_id'                => $trade_permit->company_id,
            'trade_permit_status_id'    => $trade_permit->trade_permit_status_id,
            'created_by'                => $request->user()->id,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
            'stamp' => $trade_permit->stamp,
            'is_printed' => $trade_permit->is_printed,
            'permit_type' => $trade_permit->permit_type
        ]);
        $trade_permit->logTrade()->save($log);

        //status pembayaran
        $trade_permit->pnbp->update([
            'payment_status' => 1,
            ]);

        //historypayment
        $pnbp=$trade_permit->pnbp;
        $notes='';
        if($trade_permit->permit_type == 1){
            $notes='Pembayaran Permohonan Species dan Blanko';
        }else{
            $notes='Pembayaran Pembaharuan Permohonan Blanko';
        }

        //History Payment
        $history = new HistoryPayment([
            'pnbp_code' => $pnbp->pnbp_code,
            'notes' => $notes,
            'total_payment' => $request->get('pnbp_amount'),
            'payment_method' => $request->get('payment_method'),
            'transaction_number' => $request->get('transaction_number'),
            'log_trade_permit_id' => $log->id,
            ]);
        $history->save();

        $pnbp->history()->save($history);

        $trade_permit->company->user->notify(new VerificationPayment());

        return redirect()->route('admin.pnbp.index')->with('success', 'Pembayaran dengan kode PNBP : '.$pnbp->pnbp_code.' berhasil dibayarkan.');

    }

    public function getCode($id){
        $kode = '';
        for($a = 5; $a>strlen($id); $a--){
            $kode.='0';
        }

        $kode .= $id;

        $bulan = date('m');
        $month = "";
        switch ($bulan){
            case 1: $month='I';
                    break;
            case 2: $month='II';
                    break;
            case 3: $month='III';
                    break;
            case 4: $month='IV';
                    break;
            case 5: $month='V';
                    break;
            case 6: $month='VI';
                    break;
            case 7: $month='VII';
                    break;
            case 8: $month='VIII';
                    break;
            case 9: $month='IX';
                    break;
            case 10: $month='X';
                    break;
            case 11: $month='XI';
                    break;
            case 12: $month='XII';
                    break;
        }

        $kode.='/PNBP/'.$month.'-'.date('Y');

        return $kode;
    }

}
