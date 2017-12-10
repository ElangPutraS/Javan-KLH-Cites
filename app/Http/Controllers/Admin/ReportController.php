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
    	if($request->input('m') !== null && $request->input('y') !== null){
    		if($request->input('m') == 'all' && $request->input('y') == 'all'){
    			$payments = HistoryPayment::orderBy('created_at', 'asc')->paginate(10);
    		}else if($request->input('m') != 'all' && $request->input('y') == 'all'){
    			$payments = HistoryPayment::whereMonth('created_at', $request->input('m'))->orderBy('created_at', 'asc')->paginate(10);
    		}else if($request->input('m') == 'all' && $request->input('y') != 'all'){
    			$payments = HistoryPayment::whereYear('created_at', $request->input('y'))->orderBy('created_at', 'asc')->paginate(10);
    		}else{
    			$payments = HistoryPayment::whereMonth('created_at', $request->input('m'))->whereYear('created_at', $request->input('y'))->orderBy('created_at', 'asc')->paginate(10);
    		}
    	}else{
    		$payments = HistoryPayment::orderBy('created_at', 'asc')->paginate(10);
    	}

    	$trade_permits = LogTradePermit::get();
    	$tahun =  HistoryPayment::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

    	return view('admin.report.pnbp', compact('payments','trade_permits', 'tahun'));
    }

    public function reportSatsln(Request $request)
    {
        if($request->input('m') !== null && $request->input('y') !== null){
            if($request->input('m') == 'all' && $request->input('y') == 'all'){
                $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                    $query->where('status_code', '600');
                })->orderBy('created_at','asc')->paginate(10);
            }else if($request->input('m') != 'all' && $request->input('y') == 'all'){
                $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                    $query->where('status_code', '600');
                })->whereMonth('created_at', $request->input('m'))->orderBy('created_at','asc')->paginate(10);
            }else if($request->input('m') == 'all' && $request->input('y') != 'all'){
                $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                    $query->where('status_code', '600');
                })->whereYear('created_at', $request->input('y'))->orderBy('created_at','asc')->paginate(10);
            }else{
                $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                    $query->where('status_code', '600');
                })->whereMonth('created_at', $request->input('m'))->whereYear('created_at', $request->input('y'))->orderBy('created_at','asc')->paginate(10);
            }
        }else{
            $trade_permits = LogTradePermit::whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '600');
            })->orderBy('created_at','asc')->paginate(10);
        }

        $tahun =  LogTradePermit::select(DB::raw('YEAR(created_at) year'))->distinct()->get();

        return view('admin.report.satsln', compact('trade_permits', 'tahun'));   
    }
}
