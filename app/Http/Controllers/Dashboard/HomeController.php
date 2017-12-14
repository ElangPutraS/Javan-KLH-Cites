<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	// User
    	$nowDate = date('Y-m');
    	if(auth()->user()->roles->first()->id == 2){
            $tradePermit = \App\TradePermit::where([['date_submission', 'like', $nowDate.'-%'],['company_id', $request->user()->company->id]])->orderBy('date_submission', 'desc')->get();
        }else{
            $tradePermit = \App\TradePermit::where('date_submission', 'like', $nowDate.'-%')->orderBy('date_submission', 'desc')->get();
        }

    	$news = \App\News::orderBy('created_at', 'desc')->limit(3)->get();
    	// Admin
    	$tradePermitAssign = \App\TradePermit::count();
    	$tradePermitAssignCheck = \App\TradePermit::whereHas('tradeStatus', function ($q) {
    		$q->where('status_code', '=', 600);
    		$q->orWhere('status_code', '=', 700);
    	})->count();
    	$role = \App\User::whereHas('roles', function ($q) {
    		$q->where('id', '=', 2);
    	})->count();
    	$pnpb = \App\Pnbp::with('tradePermit')->whereHas('tradePermit', function ($q) use ($nowDate) {
    		$q->where('date_submission', 'like', $nowDate.'-%')->orderBy('date_submission', 'desc');
    	})->get();

        return view('dashboard.home.index', compact('tradePermit', 'news', 'tradePermitAssign', 'tradePermitAssignCheck', 'role', 'pnpb'));
    }
}
