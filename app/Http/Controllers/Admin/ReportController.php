<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HistoryPayment;
use DB;
use App\LogTradePermit;

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
}
