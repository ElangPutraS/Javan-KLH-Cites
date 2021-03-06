<?php

namespace App\Http\Controllers\Admin;

use App\GeneralValue;
use App\Http\Requests\PnbpUpdateRequest;
use App\Http\Requests\PnbpPaymentRequest;
use App\LogTradePermit;
use App\Notifications\InvoiceSubmission;
use App\Percentage;
use App\Pnbp;
use App\TradePermit;
use App\TradePermitStatus;
use App\HistoryPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\VerificationPayment;

class PnbpController extends Controller
{

    public function index(Request $request)
    {
        $trade_permit_code = $request->input('trade_permit_code');
        $pnbp_code         = $request->input('pnbp_code');
        $company_name      = $request->input('company_name');
        $date_from         = $request->input('date_from');
        $date_until        = $request->input('date_until');

        $trade_permits = TradePermit::query();

        $trade_permits = $trade_permits->whereHas('tradeStatus', function ($query) {
                    $query->where('status_code', '200');
                })->where('is_printed', '=', 1);

        if($request->filled('trade_permit_code')){
            $trade_permits = $trade_permits->where('trade_permit_code', 'like', '%'.$trade_permit_code.'%');
        }

        if($request->filled('pnbp_code')){
            $trade_permits = $trade_permits->whereHas('pnbp', function ($q) use ($pnbp_code) {
                        $q->where('pnbp_code', 'like', '%'.$pnbp_code.'%');
                    });
        }

        if($request->filled('company_name')){
            $trade_permits = $trade_permits->whereHas('company', function ($q) use ($company_name) {
                        $q->where('company_name', 'like', '%'.$company_name.'%');
                    });
        }

        if($request->filled('date_from') && $request->filled('date_until')){

            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $trade_permits = $trade_permits->whereBetween('valid_start', [$date_from, $date_until]);
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('valid_start', '=', $date_until);
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('valid_start', '=', $date_from);
        }

        $trade_permits = $trade_permits->orderBy('trade_permit_code', 'desc')->paginate(10);

        $percentages = Percentage::all();
        $generalValueBlangko = GeneralValue::findOrFail(1);

        return view('admin.pnbp.index', compact('trade_permits', 'percentages', 'generalValueBlangko'));
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

        //notifikasi tagihan email
        $harga_blanko = GeneralValue::where('name', 'Harga Blangko')->first();
        $company = $trade_permit->company;
        $data_notif = [
            'company_name' => $company->company_name,
            'trade_permit_code' => $trade_permit->trade_permit_code,
            'permit_type' => $trade_permit->permit_type,
            'harga_blanko' => $harga_blanko->value,
            'pnbp_percentage' => $trade_permit->pnbp->pnbp_percentage_amount,
            'pnbp_subAmount' => $trade_permit->pnbp->pnbp_sub_amount,
            'total_pnbp' => $trade_permit->pnbp->pnbp_amount];
        $company->user->notify(new InvoiceSubmission($data_notif));

        //notifikasi ke user
        $company->user->notify(new \App\Notifications\Pnbp($company->user, $trade_permit, $pnbp));

        return redirect()->route('admin.pnbp.index')->with('success', 'Data berhasil dibuat.');
    }

    public function showPayment($id)
    {
        $trade_permit   =   TradePermit::findOrFail($id);
        $percentages = Percentage::all();
        $generalValueBlangko = GeneralValue::findOrFail(1);
        $generalValueTambahUang = GeneralValue::findOrFail(2);
        
        return view('admin.pnbp.payment', compact('trade_permit', 'percentages', 'generalValueBlangko', 'generalValueTambahUang'));
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
            'permit_type'               => $trade_permit->permit_type,
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
        $pnbp = $trade_permit->pnbp;
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

        //notifikasi ke user
        $company = $trade_permit->company;
        $company->user->notify(new \App\Notifications\Pnbp($company->user, $trade_permit, $pnbp));

        //notifikasi email
        $trade_permit->company->user->notify(new VerificationPayment($company, $trade_permit));

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
