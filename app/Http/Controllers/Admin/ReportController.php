<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryPayment;
use App\LogTradePermit;
use App\TradePermit;
use DB;

class ReportController extends Controller
{
    public function reportPnbp(Request $request)
    {
    	$year = $request->input('y');
        $month = $request->input('m');

        if($year == 'all' && $month == 'all' || $year === null && $month === null){
            $payments = HistoryPayment::orderBy('created_at', 'asc')->paginate(10);
        }else{
            if($year != 'all' && $month != 'all'){
                $reqDate = date('Y-m', strtotime($year . '-' . $month)).'%';
            }else if($year == 'all' && $month != 'all'){
                $reqDate = '%'.date('m', strtotime($month)).'%';
            }else if($year != 'all' && $month == 'all'){
                $reqDate = date('Y', strtotime($year)).'%';
            }

            $payments = HistoryPayment::where('created_at', 'like', $reqDate)->orderBy('created_at', 'asc')->paginate(10);
        }

    	$trade_permits = LogTradePermit::get();
    	$tahun =  HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

    	return view('admin.report.pnbp', compact('payments','trade_permits', 'tahun'));
    }

    public function reportSatsln(Request $request)
    {
        $year = $request->input('y');
        $month = $request->input('m');

        if($year == 'all' && $month == 'all' || $year === null && $month === null){
            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '600');
            })->orderBy('created_at','asc')->paginate(10);
        }else{
            if($year != 'all' && $month != 'all'){
                $reqDate = date('Y-m', strtotime($year . '-' . $month)).'%';
            }else if($year == 'all' && $month != 'all'){
                $reqDate = '%'.date('m', strtotime($month)).'%';
            }else if($year != 'all' && $month == 'all'){
                $reqDate = date('Y', strtotime($year)).'%';
            }

            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($q) use ($reqDate) {
                $q->where('status_code', '600');
            })->where('created_at', 'like', $reqDate)->paginate(10);
        }

        $tahun =  LogTradePermit::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        return view('admin.report.satsln', compact('trade_permits', 'tahun'));   
    }
}
