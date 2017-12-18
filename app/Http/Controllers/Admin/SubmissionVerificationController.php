<?php

namespace App\Http\Controllers\Admin;

use App\HistoryQuota;
use App\LogTradePermit;
use App\SpeciesQuota;
use App\TradePermit;
use App\TradePermitStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SubmissionVerification;
use App\Notifications\SubmissionVerificationRen;
use App\Notifications\SubmissionVerificationReject;
use App\Notifications\SubmissionVerificationRejectRen;

class SubmissionVerificationController extends Controller
{
    public function index()
    {
        $trade_permits = TradePermit::where('permit_type','1')->orderBy('date_submission', 'desc')->paginate(10);

        return view('admin.verificationSub.index', compact('trade_permits'));
    }

    public function show($id){
        $trade_permit = TradePermit::findOrFail($id);
       // dd($trade_permit);
        $user=User::withTrashed()->findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationSub.detail', compact('trade_permit','user'));
    }

    public function update(Request $request, $id, $period){
        $trade_permit = TradePermit::findOrFail($id);
        $company = $trade_permit->company;

        $valid_start = Carbon::now()->format('Y-m-d');
        $valid_until = Carbon::now()->addMonth($period)->format('Y-m-d');


        $trade_permit->update([
            'valid_start' => $valid_start,
            'valid_until' => $valid_until,
            'period'      => $period,
            'updated_by' => $request->user()->id
        ]);

        $status = TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description'           => 'Verifikasi Permohonan Diterima',
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

        ]);
        $trade_permit->logTrade()->save($log);

        //Update Realisasi Kuota Perusahaan
        foreach ($trade_permit->tradeSpecies as $species){
            $kuota = $species->companyQuota()->first();
            $kuota->pivot->where([['company_id', $company->id], ['species_id', $species->id], ['year', date('Y')]])->update([
                'realization' => $species->pivot->total_exported,
                ]);
        }

        $trade_permit->company->user->notify(new SubmissionVerification());

        return redirect()->route('admin.verificationSub.index')->with('success', 'Permohonan berhasil diverifikasi.');
    }

    public function updateRej(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        $trade_permit->update([
            'updated_by' => $request->user()->id,
            'reject_reason' => $request->get('alasan'),
        ]);

        $status = TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();


        //nambahin log
        $log=LogTradePermit::create([
            'log_description'           => 'Verifikasi Permohonan Ditolak',
            'trade_permit_code'         => $trade_permit->trade_permit_code,
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
        ]);
        $trade_permit->logTrade()->save($log);

        $alasan = $request->get('alasan');
        $trade_permit->company->user->notify(new SubmissionVerificationReject($alasan));
    }

    //Verifikasi Renewal

    public function indexRen()
    {
        $trade_permits = TradePermit::where('permit_type','2')->orderBy('date_submission', 'desc')->paginate(10);

        return view('admin.verificationRen.index', compact('trade_permits'));
    }

    public function showRen($id){
        $trade_permit = TradePermit::findOrFail($id);

        $user=User::findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationRen.detail', compact('trade_permit','user'));
    }

    public function updateRen(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        /*if($trade_permit->is_renewal == 1){
            $valid_start = Carbon::parse($trade_permit->valid_until)->format('Y-m-d');
            $valid_until = Carbon::now()->addMonth($request->get('period'))->format('Y-m-d');
            $trade_permit->update([
                'valid_start' => $valid_start,
                'valid_until' => $valid_until,
                'updated_by' => $request->user()->id
            ]);
        }else{
            $trade_permit->update([
                'updated_by' => $request->user()->id
            ]);
        }

        if($trade_permit->is_blanko == 1){
            $trade_permit->update([
                'trade_permit_code' => $this->create_kode($trade_permit->id),
            ]);
        }

        $status = TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //update pnbp
        $pnbp_last      =   Pnbp::orderBy('id','desc')->first();
        $trade_permit->pnbp->update([
            'pnbp_code'     => getCodePnbp($pnbp_last->id+1),
            'pnbp_amount'   => 100000,
            'payment_status'=> 0,
        ]);

        //nambahin log
        $log=LogTradePermit::create([
            'log_description'           => 'Verifikasi Permohonan Pembaharuan Diterima',
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
            'valid_renewal'             => $trade_permit->valid_renewal,
            'permit_type'               => $trade_permit->permit_type,
            'created_by'                => $request->user()->id,

        ]);
        $trade_permit->logTrade()->save($log);*/
        dd($request);
        //update realisasi
        foreach ($request->get('detail_id') as $key => $id) {
            $detail = $trade_permit->tradeSpecies->first();
            $detail->pivot->where('id', $id)->update([
                'total_exported'    => $request->get('exported_before')[$key]
                ]);

            $trade_permit->tradeSpecies()->attach([
                'total_exported' => $request->get('exported_now')[$key],
                'log_trade_permit_id' => 1,//$log->id, 
                'description' => $detail->pivot->where('id', $id)->description, 
                'valid_renewal' => $trade_permit->valid_renewal
                ]);
        }

        //$trade_permit->company->user->notify(new SubmissionVerificationRen());

        return redirect()->route('admin.verificationRen.index')->with('success', 'Permohonan berhasil diverifikasi.');
    }

    public function updateRejectRen(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        $trade_permit->update([
            'updated_by' => $request->user()->id
        ]);

        $status = TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description'           => 'Verifikasi Permohonan Pembaharuan Ditolak',
            'trade_permit_code'         => $trade_permit->trade_permit_code,
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
            'valid_renewal'             => $trade_permit->valid_renewal,
            'permit_type'               => $trade_permit->permit_type,
            'created_by'                => $request->user()->id,
        ]);
        $trade_permit->logTrade()->save($log);

        $alasan = $request->get('alasan');
        $trade_permit->company->user->notify(new SubmissionVerificationRejectRen($alasan));

        return redirect()->route('admin.verificationSub.index')->with('success', 'Verifikasi permohonan pembaharuan berhasil ditolak.');
    }

    public function updateRejection(Request $request, $id)
    {
        $trade_permit=TradePermit::findOrFail($id);
        $trade_permit->update([
            'trade_permit_status_id' =>'3',
            'reject_reason' => $request->alasan,
            'valid_renewal' => $trade_permit->valid_renewal+1,
        ]);

        $alasan = $request->get('alasan');
        $trade_permit->company->user->notify(new SubmissionVerificationRejectRen($alasan));

        return $trade_permit;
    }

    public function create_kode($id)
    {
        $kode = '';
        for($a = 5; $a>strlen($id); $a--){
            $kode.='0';
        }

        $kode .= $id;

        $bulan = date('m');
        $month = "";
        switch ($bulan){
            case 1: $month = 'I';
                break;
            case 2: $month = 'II';
                break;
            case 3: $month = 'III';
                break;
            case 4: $month = 'IV';
                break;
            case 5: $month = 'V';
                break;
            case 6: $month = 'VI';
                break;
            case 7: $month = 'VII';
                break;
            case 8: $month = 'VIII';
                break;
            case 9: $month = 'IX';
                break;
            case 10: $month = 'X';
                break;
            case 11: $month = 'XI';
                break;
            case 12: $month = 'XII';
                break;
        }

        $kode .= '/'.$month.'/SATS-LN/'.date('Y');


        return $kode;
    }

    public function getCodePnbp($id){
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