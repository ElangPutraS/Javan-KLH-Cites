<?php

namespace App\Http\Controllers\Admin;

use App\HistoryQuota;
use App\LogTradePermit;
use App\Notifications\SubmissionVerificationDb;
use App\Pnbp;
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
    public function index(Request $request)
    {
        $code           = $request->input('code');
        $company_name   = $request->input('company_name');
        $status_search  = $request->input('status');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $trade_permits = TradePermit::query();

        if($request->filled('code')){
            $trade_permits = $trade_permits->where('trade_permit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('company_name')){
            $trade_permits = $trade_permits->whereHas('company', function ($q) use($company_name) {
                                $q->where('company_name', 'like', '%'.$company_name.'%');
                            });
        }

        if($request->filled('status')){
            $trade_permits = $trade_permits->where('trade_permit_status_id', '=', $status_search);
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $trade_permits = $trade_permits->whereBetween('date_submission', [$date_from, $date_until]);
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('date_submission', '=', $date_until);
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('date_submission', '=', $date_from);
        }

        $trade_permits = $trade_permits->where('permit_type', '1')->orderBy('created_at', 'desc')->paginate(10);

        $status = TradePermitStatus::orderBy('status_code')->get();
        return view('admin.verificationSub.index', compact('trade_permits', 'status'));
    }

    public function show($id){
        $trade_permit = TradePermit::findOrFail($id);

        $user=User::withTrashed()->findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationSub.detail', compact('trade_permit','user'));
    }

    public function update(Request $request, $id, $period){
        $trade_permit = TradePermit::findOrFail($id);
        $company = $trade_permit->company;

        //susun kode trade permit
        $trade_last      =   TradePermit::orderBy('trade_permit_code','desc')->first();
        $id='';
        if($trade_last === null || $trade_last->trade_permit_code == '' || $trade_last->trade_permit_code == ' '){
            $id = 1;
        }else{
            $id = substr($trade_last->trade_permit_code,0,5) + 1;
        }

        //valid start dan valid until
        $valid_start = Carbon::now()->format('Y-m-d');
        $valid_until = Carbon::now()->addMonth($period)->format('Y-m-d');

        $trade_permit->update([
            'trade_permit_code' => $this->create_kode($id),
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
            'is_printed'                => $trade_permit->is_print,
            'stamp'                     => $trade_permit->stamp,

        ]);
        $trade_permit->logTrade()->save($log);

        //Update Realisasi Kuota Perusahaan
        foreach ($trade_permit->tradeSpecies as $species){
            $realization = $species->pivot->where([['company_id', $company->id], ['species_id', $species->id], ['year', date('Y')]])->sum('total_exported');

            $kuota = $species->companyQuota()->first();
            $kuota->pivot->where([['company_id', $company->id], ['species_id', $species->id], ['year', date('Y')]])->update([
                'realization' => $realization,
                ]);
        }

        //notifikasi ke user
        $company->user->notify(new SubmissionVerificationDb($company->user, $trade_permit));

        //notifikasi email
        $trade_permit->company->user->notify(new SubmissionVerification($company, $trade_permit));

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
            'is_printed'                => $trade_permit->is_print,
            'stamp'                     => $trade_permit->stamp,
        ]);
        $trade_permit->logTrade()->save($log);

        //set trade permit detail 0
        foreach ($trade_permit->tradeSpecies as $species){
            $cek = $species->pivot->update([
                'total_exported'    => 0
                ]);
        }

        //notifikasi ke user
        $company = $trade_permit->company;
        $company->user->notify(new SubmissionVerificationDb($company->user, $trade_permit));

        //notifikasi email
        $company->user->notify(new SubmissionVerificationReject($company, $trade_permit));
    }

    //Verifikasi Renewal

    public function indexRen(Request $request)
    {
        $code           = $request->input('code');
        $company_name   = $request->input('company_name');
        $status_search  = $request->input('status');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $trade_permits = TradePermit::query();

        $trade_permits = $trade_permits->where('permit_type','2');

        if($request->filled('code')){
            $trade_permits = $trade_permits->where('trade_permit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('company_name')){
            $trade_permits = $trade_permits->whereHas('company', function ($q) use($company_name) {
                $q->where('company_name', 'like', '%'.$company_name.'%');
            });
        }

        if($request->filled('status')){
            $trade_permits = $trade_permits->where('trade_permit_status_id', '=', $status_search);
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $trade_permits = $trade_permits->whereBetween('date_submission', [$date_from, $date_until]);
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('date_submission', '=', $date_until);
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $trade_permits = $trade_permits->whereDate('date_submission', '=', $date_from);
        }

        $trade_permits = $trade_permits->orderBy('created_at', 'desc')->paginate(10);

        $status = TradePermitStatus::orderBy('status_code')->get();
        return view('admin.verificationRen.index', compact('trade_permits', 'status'));
    }

    public function showRen($id){
        $trade_permit = TradePermit::findOrFail($id);

        $user=User::findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationRen.detail', compact('trade_permit','user'));
    }

    public function updateRen(Request $request, $id){
        $trade_permit = TradePermit::findOrFail($id);

        if($trade_permit->is_renewal == 1){
            $valid_start = Carbon::createFromFormat('Y-m-d', $trade_permit->valid_until);
            $valid_until = Carbon::createFromFormat('Y-m-d', $trade_permit->valid_until)->addMonth($request->get('period'))->format('Y-m-d');

            $trade_permit->update([
                'valid_start' => $valid_start->format('Y-m-d'),
                'valid_until' => $valid_until,
                'period'      => $request->get('period'),
                'updated_by' => $request->user()->id
            ]);
        }else{
            $trade_permit->update([
                'updated_by' => $request->user()->id
            ]);
        }

        if($trade_permit->is_blanko == 1){
            $trade_last      =   TradePermit::orderBy('trade_permit_code','desc')->first();
            $id='';
            if($trade_last === null){
                $id = 1;
            }else{
                $id = substr($trade_last->trade_permit_code,0,5) + 1;
            }

            $trade_permit->update([
                'trade_permit_code' => $this->create_kode($id),
            ]);
        }

        $status = TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //update pnbp
        $pnbp_last      =   Pnbp::orderBy('pnbp_code','desc')->first();
        $id='';
        if($pnbp_last === null){
            $id = 1;
        }else{
            $id = substr($pnbp_last->pnbp_code,0,5) + 1;
        }

        $trade_permit->pnbp->update([
            'pnbp_code'     => $this->getCodePnbp($id),
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
            'permit_type'               => 2,
            'created_by'                => $request->user()->id,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
            'is_printed'                => $trade_permit->is_print,
            'stamp'                     => $trade_permit->stamp,
        ]);
        $trade_permit->logTrade()->save($log);

        //update realisasi
        foreach ($request->get('detail_id') as $key => $id) {
            $detail = $trade_permit->tradeSpecies()->first();
            $detail->pivot->where('id', $id)->update([
                'total_exported'    => $request->get('exported_before')[$key]
                ]);

            $kuota = $detail->pivot->where('id', $id)->first();

            $trade_permit->tradeSpecies()->attach($kuota->species_id, [
                'total_exported' => $request->get('exported_now')[$key],
                'log_trade_permit_id' => $log->id,
                'description' => $kuota->description,
                'valid_renewal' => $trade_permit->valid_renewal,
                'company_id'    => $trade_permit->company_id,
                'year'      => date('Y')
                ]);

            //update realisasi di kuota perusahaan
            $realization = $detail->pivot->where([['company_id', $trade_permit->company_id], ['year', date('Y')], ['species_id', $detail->id]])->sum('total_exported');

            $kuota = $detail->companyQuota()->first();
            $kuota->pivot->where('id', $id)->update([
                'realization'  => $realization,
            ]);
        }

        //notifikasi ke user
        $company = $trade_permit->company;
        $company->user->notify(new SubmissionVerificationDb($company->user, $trade_permit));

        //notifikasi email
        $trade_permit->company->user->notify(new SubmissionVerificationRen($company, $trade_permit));

        return redirect()->route('admin.verificationRen.index')->with('success', 'Permohonan berhasil diverifikasi.');
    }

    public function updateRejection(Request $request, $id)
    {
        $trade_permit=TradePermit::findOrFail($id);

        $trade_permit->update([
            'reject_reason' => $request->alasan,
            'valid_renewal' => $trade_permit->valid_renewal,
        ]);

        $status = TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log = LogTradePermit::create([
            'log_description'           => 'Verifikasi Permohonan Pembaharuan Ditolak',
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
            'permit_type'               => 2,
            'created_by'                => $request->user()->id,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
            'is_printed'                => $trade_permit->is_print,
            'stamp'                     => $trade_permit->stamp,
        ]);
        $trade_permit->logTrade()->save($log);

        foreach ($trade_permit->tradeSpecies as $key => $species){
            $status = $trade_permit->tradeSpecies()->wherePivot('valid_renewal', ($trade_permit->valid_renewal - 1))->updateExistingPivot($species->id, [
                'valid_renewal'         => $trade_permit->valid_renewal,
            ]);
        }

        //notifikasi ke user
        $company = $trade_permit->company;
        $company->user->notify(new SubmissionVerificationDb($company->user, $trade_permit));

        //notifikasi ke email
        $company->user->notify(new SubmissionVerificationRejectRen($company, $trade_permit));

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