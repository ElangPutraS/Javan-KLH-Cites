<?php

namespace App\Http\Controllers\Admin;

use App\GeneralValue;
use App\Notifications\InvoiceSubmission;
use App\Percentage;
use App\Species;
use App\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryPayment;
use App\LogTradePermit;
use App\TradePermit;
use DB;
use Spatie\ArrayToXml\ArrayToXml;

class ReportController extends Controller
{
    public function reportPnbp(Request $request)
    {
        $year = $request->input('y');
        $month = $request->input('m');

        if ($year == 'all' && $month == 'all' || $year === null && $month === null) {
            $payments = HistoryPayment::whereHas('pnbp')->orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%-' . $month . '-%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = $year . '-%';
            }

            $payments = HistoryPayment::whereHas('pnbp')->where('created_at', 'like', $reqDate)->orderBy('created_at', 'asc')->paginate(10);
        }

        $trade_permits = LogTradePermit::whereHas('tradePermit', function ($q) {
            $q->where('is_printed', '=', 0);
        })->get();
        $tahun = HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();
        $generalValueBlangko = GeneralValue::findOrFail(1);

        return view('admin.report.pnbp', compact('payments', 'trade_permits', 'tahun', 'percentages', 'generalValueBlangko'));
    }

    public function printReportPnbp($m = 'all', $y = 'all')
    {
        $year = $y;
        $month = $m;

        if ($year == 'all' && $month == 'all' || $year === null && $month === null) {
            $payments = HistoryPayment::orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%-' . $month . '-%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = $year . '-%';
            }

            $payments = HistoryPayment::where('created_at', 'like', $reqDate)->orderBy('created_at', 'asc')->paginate(10);
        }

        $trade_permits = LogTradePermit::get();
        $tahun = HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();
        $generalValueBlangko = GeneralValue::findOrFail(1);

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-pnbp', compact('payments', 'trade_permits', 'tahun', 'month', 'year', 'generalValueBlangko'));
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }

    public function printReportDetailSatsln($id, $percentage = 0)
    {
        $tradePermit = LogTradePermit::with(['tradePermit'])->where('id', $id)->first();
        $generalValueBlangko = GeneralValue::findOrFail(1);

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-detail-satsln', compact('tradePermit', 'percentage', 'generalValueBlangko'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
        //print_r($tradePermit);
    }

    public function reportSatsln(Request $request)
    {
        $year = $request->input('y');
        $month = $request->input('m');

        if ($year == 'all' && $month == 'all' || $year === null && $month === null) {
            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '600');
            })->orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '-%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%-' . $month . '-%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = $year . '-%';
            }

            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($q) use ($reqDate) {
                $q->where('status_code', '600');
            })->where('created_at', 'like', $reqDate)->paginate(10);
        }

        $tahun = LogTradePermit::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        return view('admin.report.satsln', compact('trade_permits', 'tahun'));
    }

    public function printReportSatsln($m = 'all', $y = 'all')
    {
        $year = $y;
        $month = $m;

        //dd($year.' '.$month);

        if ($year == 'all' && $month == 'all' || $year === null && $month === null) {
            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '600');
            })->orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%-' . $month . '-%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = $year . '-%';
            }

            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($q) use ($reqDate) {
                $q->where('status_code', '600');
            })->where('created_at', 'like', $reqDate)->paginate(10);
        }

        $tahun = LogTradePermit::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-satsln', compact('trade_permits', 'tahun', 'month', 'year'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function portalInsw(Request $request)
    {
        $code              = $request->input('code');
        $company_name      = $request->input('company_name');
        $date_from         = $request->input('date_from');
        $date_until        = $request->input('date_until');

        $tradePermit = LogTradePermit::query();

        $tradePermit = $tradePermit->where('is_printed', 1)
                        ->whereHas('tradeStatus', function ($q) {
                            $q->where('status_code', '600');
                            $q->orWhere('status_code', '700');
                        });

        if($request->filled('code')){
            $tradePermit = $tradePermit->where('trade_permit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('company_name')){
            $tradePermit = $tradePermit->whereHas('company', function ($q) use ($company_name) {
                $q->where('company_name', 'like', '%'.$company_name.'%');
            });
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $tradePermit = $tradePermit->whereBetween('valid_until', [$date_from, $date_until]);
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $tradePermit = $tradePermit->whereDate('valid_until', '=', $date_until);
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $tradePermit = $tradePermit->whereDate('valid_until', '=', $date_from);
        }

        $tradePermit = $tradePermit->orderBy('updated_at', 'desc')->paginate(10);


        return view('admin.report.portal-insw', compact('tradePermit'));
    }

    public function sendInsw($tradePermitId)
    {
        $tradePermit = LogTradePermit::findOrFail($tradePermitId);

        $send = [
            'header' => [
                'noPengajuan' => $tradePermit->trade_permit_id,
                'tglPengajuan' => $tradePermit->date_submission,
                'jnsPengajuan' => $tradePermit->purposeType->purpose_type_name,
                'kdPengajuan' => $tradePermit->trade_permit_code,
                'jnsPerijinan' => $tradePermit->tradingType->trading_type_name,
                'statusPerijinan' => $tradePermit->tradeStatus->status_name,
                'noPerijinan' => null,
                'tglPerijinan' => $tradePermit->date_submission,
                'tglAwalPerijinan' => $tradePermit->valid_start,
                'tglAkhirPerijinan' => $tradePermit->valid_until,
                'kdInstansi' => null,
                'kdKantor' => null,
                'kdDirektorat' => null,
                'remarks' => null,
                'narahubung' => [
                    'nama' => null,
                    'jabatan' => null,
                    'identitas' => null
                ],
                'kota' => null
            ],
            'trader' => [
                'tipe' => $tradePermit->tradingType->trading_type_name,
                'jnsID' => null,
                'npwp' => $tradePermit->company->npwp_number,
                'nama' => $tradePermit->company->company_name,
                'alamat' => $tradePermit->company->company_address,
                'kdpos' => null,
                'kota' => $tradePermit->company->city->city_name_full,
                'propinsi' => $tradePermit->company->province->province_name,
                'negara' => $tradePermit->company->country->country_name,
                'telp' => null,
                'fax' => $tradePermit->company->company_fax,
                'email' => $tradePermit->company->email,
                'narahubung' => [
                    'nama' => null,
                    'jabatan' => null,
                    'alamat' => null,
                    'identitas' => null,
                    'telp' => null,
                    'email' => null
                ]
            ],
            'sla' => [
                'kodeStatus' => null,
                'wkStatus' => null,
                'uraianStatus' => null,
                'standardSLA' => null,
                'idPetugas' => null,
                'nmPetugas' => null
            ],
            'referensi' => [
                'jnsDok' => null,
                'noDok' => null,
                'tglDok' => $tradePermit->date_submission,
                'kdDok' => null,
                'penerbit' => null,
                'negpenerbit' => null
            ],
            'transportasi' => [
                'moda' => [
                    'jnsmoda' => null,
                    'angkutno' => null,
                    'angkutnama' => null,
                    'tgltiba' => null
                ],
                'lokasi' => [
                    'negmuat' => [
                        'kdNegara' => 'ID'
                    ],
                    'negbkr' => 'Indonesia',
                    'negTrans' => [
                        'kdNegara' => 'ID'
                    ],
                    'plbmuat' => $tradePermit->portExpor->port_name,
                    'plbbkr' => [
                        'kdPelabuhan' => $tradePermit->portExpor->port_code
                    ],
                    'plbtrans' => [
                        'kdPelabuhan' => $tradePermit->portDest->port_code
                    ],
                    'tmptimbun' => null
                ],
                'tmpinstalasi' => [
                    'nama' => null,
                    'alamat' => null
                ],
                'tujuan' => [
                    'tujmasuk' => null,
                    'drhtuju' => null,
                    'negtuju' => null
                ],
                'container' => [
                    'nocont' => null,
                    'segel' => null
                ]
            ],
            'komoditas' => [
                'serial' => null,
                'noHS' => null,
                'deskripsiHS' => null,
                'uraianBarang' => null,
                'nmLatin' => null,
                'sediaan' => null,
                'periode' => null,
                'flagperubahan' => null,
                'jmlSatuan' => null,
                'jnsSatuan' => null,
                'nobatch' => null,
                'noCAS' => null,
                'negTujuan' => [
                    'kdNegara' => null
                ],
                'pelAsal' => [
                    'kdPelabuhan' => null
                ],
                'pelBkr' => [
                    'kdPelabuhan' => null
                ],
                'netto' => null
            ]
        ];

        $result = ArrayToXml::convert($tradePermit->toArray(), 'persetujuan');

        return response($result, 200, ['Content-Type' => 'text/xml', 'charset' => 'UTF-8']);
    }

    public function printSatsln(Request $request, $id)
    {
        $user = $request->user();
        $trade_permit = TradePermit::findOrFail($id);

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.satsln', compact('user', 'trade_permit'));

        $pdf->setPaper('folio', 'portrait');

        return $pdf->stream();
    }

    public function storeStampSatsln(Request $request)
    {
        $tradePermit = TradePermit::findOrFail($request->id);
        $tradePermit->stamp = $request->stamp;

        if ($tradePermit->save()) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function storeIsPrinted(Request $request)
    {
        $tradePermit = TradePermit::findOrFail($request->id);
        $tradePermit->is_printed = $request->is_printed;

        if($tradePermit->permit_type == 2){
            //notifikasi tagihan email
            $harga_blanko = GeneralValue::where('name', 'Harga Blangko')->first();
            $company = $tradePermit->company;
            $data_notif = [
                'company_name' => $company->company_name,
                'trade_permit_code' => $tradePermit->trade_permit_code,
                'permit_type' => $tradePermit->permit_type,
                'harga_blanko' => $harga_blanko->value,
                'pnbp_percentage' => $tradePermit->pnbp->pnbp_percentage_amount,
                'pnbp_subAmount' => $tradePermit->pnbp->pnbp_sub_amount,
                'total_pnbp' => $tradePermit->pnbp->pnbp_amount];
            $company->user->notify(new InvoiceSubmission($data_notif));
        }

        if ($tradePermit->save()) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function companyInvestation(Request $request)
    {
        $company_name   = $request->input('company_name');
        $owner_name     = $request->input('owner_name');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $users = User::query();

        if($request->filled('company_name')){
            $users = $users->whereHas('company',  function ($q) use($company_name) {
                        $q->where('company_name', 'like', '%'.$company_name.'%');
                    });
        }

        if($request->filled('owner_name')){
            $users = $users->whereHas('company',  function ($q) use($owner_name) {
                        $q->where('owner_name', 'like', '%'.$owner_name.'%');
                    });
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $users = $users->whereHas('company',  function ($q) use($company_name, $owner_name, $date_from, $date_until) {
                        $q->whereBetween('created_at', [$date_from, $date_until]);
                    });
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_until) {
                        $q->whereDate('created_at', '=', $date_until);
                    });
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_from) {
                $q->whereDate('created_at', '=', $date_from);
            });
        }

        $users = $users->whereHas('roles', function ($q) {
                    $q->where('id', '=', 2);
                })->whereHas('company', function ($q) {
                    $q->where('company_status', '=', 1);
                })->paginate(10);

        return view('admin.report.investation', compact('users'));
    }

    public function printReportInvestation(Request $request)
    {
        $company_name   = $request->input('company_name');
        $owner_name     = $request->input('owner_name');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $users = User::query();

        if($request->filled('company_name')){
            $users = $users->whereHas('company',  function ($q) use($company_name) {
                $q->where('company_name', 'like', '%'.$company_name.'%');
            });
        }

        if($request->filled('owner_name')){
            $users = $users->whereHas('company',  function ($q) use($owner_name) {
                $q->where('owner_name', 'like', '%'.$owner_name.'%');
            });
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $users = $users->whereHas('company',  function ($q) use($company_name, $owner_name, $date_from, $date_until) {
                $q->whereBetween('created_at', [$date_from, $date_until]);
            });
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_until) {
                $q->whereDate('created_at', '=', $date_until);
            });
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_from) {
                $q->whereDate('created_at', '=', $date_from);
            });
        }

        $users = $users->whereHas('roles', function ($q) {
            $q->where('id', '=', 2);
        })->whereHas('company', function ($q) {
            $q->where('company_status', '=', 1);
        })->paginate(10);

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-investation', compact('users'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function companyLabor(Request $request)
    {
        $company_name   = $request->input('company_name');
        $owner_name     = $request->input('owner_name');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $users = User::query();

        if($request->filled('company_name')){
            $users = $users->whereHas('company',  function ($q) use($company_name) {
                $q->where('company_name', 'like', '%'.$company_name.'%');
            });
        }

        if($request->filled('owner_name')){
            $users = $users->whereHas('company',  function ($q) use($owner_name) {
                $q->where('owner_name', 'like', '%'.$owner_name.'%');
            });
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $users = $users->whereHas('company',  function ($q) use($company_name, $owner_name, $date_from, $date_until) {
                $q->whereBetween('created_at', [$date_from, $date_until]);
            });
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_until) {
                $q->whereDate('created_at', '=', $date_until);
            });
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_from) {
                $q->whereDate('created_at', '=', $date_from);
            });
        }

        $users = $users->whereHas('roles', function ($q) {
            $q->where('id', '=', 2);
        })->whereHas('company', function ($q) {
            $q->where('company_status', '=', 1);
        })->paginate(10);

        return view('admin.report.labor', compact('users'));
    }

    public function printReportLabor(Request $request)
    {
        $company_name   = $request->input('company_name');
        $owner_name     = $request->input('owner_name');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $users = User::query();

        if($request->filled('company_name')){
            $users = $users->whereHas('company',  function ($q) use($company_name) {
                $q->where('company_name', 'like', '%'.$company_name.'%');
            });
        }

        if($request->filled('owner_name')){
            $users = $users->whereHas('company',  function ($q) use($owner_name) {
                $q->where('owner_name', 'like', '%'.$owner_name.'%');
            });
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $users = $users->whereHas('company',  function ($q) use($company_name, $owner_name, $date_from, $date_until) {
                $q->whereBetween('created_at', [$date_from, $date_until]);
            });
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_until) {
                $q->whereDate('created_at', '=', $date_until);
            });
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $users = $users->whereHas('company',  function ($q) use($date_from) {
                $q->whereDate('created_at', '=', $date_from);
            });
        }

        $users = $users->whereHas('roles', function ($q) {
            $q->where('id', '=', 2);
        })->whereHas('company', function ($q) {
            $q->where('company_status', '=', 1);
        })->paginate(10);

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-labor', compact('users'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function reportForeignExchange(Request $request)
    {
        if($request->input('scientific_name') == '' && $request->input('indonesia_name') == '' && $request->input('general_name') == '' && $request->input('year') == '' || $request->input('scientific_name') == null && $request->input('indonesia_name') == null && $request->input('general_name') == null && $request->input('year') == null){
            $species = DB::table('species as s')
                ->join('trade_permit_detail as tpd', 's.id', '=', 'tpd.species_id')
                ->select('s.id as id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year as year' , DB::raw('SUM(tpd.total_exported) as total_export'))
                ->groupBy('s.id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year')
                ->havingRaw('SUM(tpd.total_exported) > 0')
                ->orderBy('tpd.year','desc')
                ->paginate(10);

        }else{
            $scientific_name = '%'.$request->input('scientific_name').'%';
            $indonesia_name  = '%'.$request->input('indonesia_name').'%';
            $general_name    = '%'.$request->input('general_name').'%';
            $year            = '%'.$request->input('year').'%';

            $species = DB::table('species as s')
                ->join('trade_permit_detail as tpd', 's.id', '=', 'tpd.species_id')
                ->select('s.id as id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year as year' , DB::raw('SUM(tpd.total_exported) as total_export'))
                ->groupBy('s.id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year')
                ->where([['species_scientific_name', 'like', $scientific_name], ['species_indonesia_name', 'like', $indonesia_name], ['species_general_name', 'like', $general_name], ['year', 'like', $year]])
                ->havingRaw('SUM(tpd.total_exported) > 0')
                ->orderBy('tpd.year','desc')
                ->paginate(10);
        }

        $years = DB::table('trade_permit_detail')
                ->select('year')->distinct()->orderBy('year', 'desc')->get();

        return view('admin.report.foreign_exchange', compact('species', 'years'));
    }

    public function printReportForeignExchange(Request $request)
    {
        if($request->input('scientific_name') == '' && $request->input('indonesia_name') == '' && $request->input('general_name') == '' && $request->input('year') == '' || $request->input('scientific_name') == null && $request->input('indonesia_name') == null && $request->input('general_name') == null && $request->input('year') == null){
            $species = DB::table('species as s')
                ->join('trade_permit_detail as tpd', 's.id', '=', 'tpd.species_id')
                ->select('s.id as id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year as year' , DB::raw('SUM(tpd.total_exported) as total_export'))
                ->groupBy('s.id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year')
                ->havingRaw('SUM(tpd.total_exported) > 0')
                ->orderBy('tpd.year','desc')
                ->paginate(10);

        }else{
            $scientific_name = '%'.$request->input('scientific_name').'%';
            $indonesia_name  = '%'.$request->input('indonesia_name').'%';
            $general_name    = '%'.$request->input('general_name').'%';
            $year            = '%'.$request->input('year').'%';

            $species = DB::table('species as s')
                ->join('trade_permit_detail as tpd', 's.id', '=', 'tpd.species_id')
                ->select('s.id as id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year as year' , DB::raw('SUM(tpd.total_exported) as total_export'))
                ->groupBy('s.id', 'species_scientific_name', 'species_indonesia_name', 'species_general_name', 'nominal', 'tpd.year')
                ->where([['species_scientific_name', 'like', $scientific_name], ['species_indonesia_name', 'like', $indonesia_name], ['species_general_name', 'like', $general_name], ['year', 'like', $year]])
                ->havingRaw('SUM(tpd.total_exported) > 0')
                ->orderBy('tpd.year','desc')
                ->paginate(10);
        }

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-foreign-exchange', compact('species'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }
}
