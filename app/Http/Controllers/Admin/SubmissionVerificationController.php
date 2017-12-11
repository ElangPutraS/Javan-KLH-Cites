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

    public function update(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        //Cek Cukup atau Engganya Kuota
        $cek='';
        foreach ($trade_permit->tradeSpecies as $species){
            $quota_species=SpeciesQuota::where([['species_id', '=', $species->id], ['year', '=', date('Y')]])->first();
            $kuota_akhir = $quota_species->quota_amount - $species->pivot->total_exported;

            if($kuota_akhir<0){
                $cek="Kuota Tidak mencukupi";
            }
        }

        if($cek == ''){
            $valid_start = Carbon::now()->format('Y-m-d');
            $valid_until = Carbon::now()->addMonth($trade_permit->period)->format('Y-m-d');


            $trade_permit->update([
                'valid_start' => $valid_start,
                'valid_until' => $valid_until,
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
            ]);
            $trade_permit->logTrade()->save($log);

            //Kurangi Kuota dan Buat History Quota
            foreach ($trade_permit->tradeSpecies as $species){
                $quota_species=SpeciesQuota::where([['species_id', '=', $species->id], ['year', '=', date('Y')]])->first();
                $kuota_akhir = $quota_species->quota_amount - $species->pivot->total_exported;

                $quota_species->update([
                    'quota_amount' => $kuota_akhir
                ]);

                HistoryQuota::create([
                    'notes'             => 'Penerbitan Surat Izin, Kuota Species dikurangi total ekspor sejumlah '.$species->pivot->total_exported,
                    'total_quota'       => $kuota_akhir,
                    'species_quota_id'  => $quota_species->id,
                    'created_by'        => $request->user()->id,
                ]);
            }

            $trade_permit->company->user->notify(new SubmissionVerification());

            return redirect()->route('admin.verificationSub.index')->with('success', 'Permohonan berhasil diverifikasi.');
        }else{
            return redirect()->route('admin.verificationSub.show', ['id' => $id])->with('warning', 'Permohonan gagal diverifikasi, kuota species yang dipilih tidak mencukupi.');
        }

    }

    public function updateRej(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        dd($request->alasan);
        $trade_permit->update([
            'updated_by' => $request->user()->id,
            'reject_reason' => $request->alasan
        ]);

        $status = TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //Ini buat get alasannya : $request->get('alasan')

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => 'Verifikasi Permohonan Ditolak',
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

        $trade_permit->update([
            'updated_by' => $request->user()->id
        ]);

        $status = TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

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
        $trade_permit->logTrade()->save($log);

        $trade_permit->company->user->notify(new SubmissionVerificationRen());

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

}
