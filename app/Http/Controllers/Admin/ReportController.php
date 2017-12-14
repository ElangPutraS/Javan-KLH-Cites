<?php

namespace App\Http\Controllers\Admin;

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
            $payments = HistoryPayment::orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%' . date('m', strtotime($month)) . '%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = date('Y', strtotime($year)) . '%';
            }

            $payments = HistoryPayment::where('created_at', 'like', $reqDate)->orderBy('created_at', 'asc')->paginate(10);
        }

        $trade_permits = LogTradePermit::get();
        $tahun = HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        return view('admin.report.pnbp', compact('payments', 'trade_permits', 'tahun'));
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
                $reqDate = '%' . date('m', strtotime($month)) . '%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = date('Y', strtotime($year)) . '%';
            }

            $payments = HistoryPayment::where('created_at', 'like', $reqDate)->orderBy('created_at', 'asc')->paginate(10);
        }

        $trade_permits = LogTradePermit::get();
        $tahun = HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-pnbp', compact('payments', 'trade_permits', 'tahun', 'month', 'year'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function printReportDetailSatsln($id)
    {
        $tradePermit = TradePermit::with(['tradeSpecies'])->where('id', '=', $id)->first();

        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $pdf = PDF::loadView('pdf.report-detail-satsln', compact('tradePermit'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
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
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%' . date('m', strtotime($month)) . '%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = date('Y', strtotime($year)) . '%';
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

        if ($year == 'all' && $month == 'all' || $year === null && $month === null) {
            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '600');
            })->orderBy('created_at', 'asc')->paginate(10);
        } else {
            if ($year != 'all' && $month != 'all') {
                $reqDate = date('Y-m', strtotime($year . '-' . $month)) . '%';
            } else if ($year == 'all' && $month != 'all') {
                $reqDate = '%' . date('m', strtotime($month)) . '%';
            } else if ($year != 'all' && $month == 'all') {
                $reqDate = date('Y', strtotime($year)) . '%';
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

    public function portalInsw()
    {
        $tradePermit = TradePermit::whereHas('tradeStatus', function ($q) {
            $q->where('status_code', '600');
            $q->orWhere('status_code', '700');
        })->orderBy('updated_at', 'desc')->get();

        return view('admin.report.portal-insw', compact('tradePermit'));
    }

    public function sendInsw($tradePermitId)
    {
        $tradePermit = TradePermit::findOrFail($tradePermitId);

        $send = [
            'header' => [
                'noPengajuan' => $tradePermit->id,
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
                'npwp' => null,
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

        return $result = ArrayToXml::convert($tradePermit->toArray(), 'persetujuan');
    }

    public function printSatsln(Request $request, $id) {
        $user = $request->user();
        $trade_permit = TradePermit::findOrFail($id);

        $pdf = PDF::loadView('pdf.satsln', compact('user', 'trade_permit'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
        //return view('pdf.satsln');
    }
}
