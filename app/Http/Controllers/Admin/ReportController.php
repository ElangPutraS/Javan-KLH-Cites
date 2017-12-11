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

        //return response()->xml($tradePermit);

        $send = [
            'header' => [
                'noPengajuan' => 'qwerty',
                'tglPengajuan' => 'qwerty',
                'jnsPengajuan' => 'qwerty',
                'kdPengajuan' => 'qwerty',
                'jnsPerijinan' => 'qwerty',
                'statusPerijinan' => 'qwerty',
                'noPerijinan' => 'qwerty',
                'tglPerijinan' => 'qwerty',
                'tglAwalPerijinan' => 'qwerty',
                'tglAkhirPerijinan' => 'qwerty',
                'kdInstansi' => 'qwerty',
                'kdKantor' => 'qwerty',
                'kdDirektorat' => 'qwerty',
                'remarks' => 'qwerty',
                'narahubung' => [
                    'nama' => 'qwerty',
                    'jabatan' => 'qwerty',
                    'identitas' => ''
                ],
                'kota' => ''
            ],
            'trader' => [
                'tipe' => 'qwerty',
                'jnsID' => 'qwerty',
                'npwp' => 'qwerty',
                'nama' => 'qwerty',
                'alamat' => 'qwerty',
                'kdpos' => 'qwerty',
                'kota' => 'qwerty',
                'propinsi' => 'qwerty',
                'negara' => 'qwerty',
                'telp' => 'qwerty',
                'fax' => 'qwerty',
                'email' => 'qwerty',
                'narahubung' => [
                    'nama' => 'qwerty',
                    'jabatan' => 'qwerty',
                    'alamat' => 'qwerty',
                    'identitas' => 'qwerty',
                    'telp' => 'qwerty',
                    'email' => ''
                ]
            ],
            'sla' => [
                'kodeStatus' => 'qwerty',
                'wkStatus' => 'qwerty',
                'uraianStatus' => 'qwerty',
                'standardSLA' => 'qwerty',
                'idPetugas' => 'qwerty',
                'nmPetugas' => ''
            ],
            'referensi' => [
                'jnsDok' => 'qwerty',
                'noDok' => 'qwerty',
                'tglDok' => 'qwerty',
                'kdDok' => 'qwerty',
                'penerbit' => 'qwerty',
                'negpenerbit' => ''
            ],
            'transportasi' => [
                'moda' => [
                    'jnsmoda' => 'qwerty',
                    'angkutno' => 'qwerty',
                    'angkutnama' => 'qwerty',
                    'tgltiba' => ''
                ],
                'lokasi' => [
                    'negmuat' => [
                        'kdNegara' => ''
                    ],
                    'negbkr' => 'qwerty',
                    'negTrans' => [
                        'kdNegara' => ''
                    ],
                    'plbmuat' => 'qwerty',
                    'plbbkr' => [
                        'kdPelabuhan' => ''
                    ],
                    'plbtrans' => [
                        'kdPelabuhan' => ''
                    ],
                    'tmptimbun' => ''
                ],
                'tmpinstalasi' => [
                    'nama' => 'qwerty',
                    'alamat' => ''
                ],
                'tujuan' => [
                    'tujmasuk' => 'qwerty',
                    'drhtuju' => 'qwerty',
                    'negtuju' => ''
                ],
                'container' => [
                    'nocont' => 'qwerty',
                    'segel' => ''
                ]
            ],
            'komoditas' => [
                'serial' => 'qwerty',
                'noHS' => 'qwerty',
                'deskripsiHS' => 'qwerty',
                'uraianBarang' => 'qwerty',
                'nmLatin' => 'qwerty',
                'sediaan' => 'qwerty',
                'periode' => 'qwerty',
                'flagperubahan' => 'qwerty',
                'jmlSatuan' => 'qwerty',
                'jnsSatuan' => 'qwerty',
                'nobatch' => 'qwerty',
                'noCAS' => 'qwerty',
                'negTujuan' => [
                    'kdNegara' => ''
                ],
                'pelAsal' => [
                    'kdPelabuhan' => ''
                ],
                'pelBkr' => [
                    'kdPelabuhan' => ''
                ],
                'netto' => ''
            ]
        ];

        return $result = ArrayToXml::convert($send, 'persetujuan');
    }
}
