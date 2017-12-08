<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
    	$nowDate = date('Y-m');
    	$tradePermit = \App\TradePermit::where('date_submission', 'like', $nowDate.'-%')->orderBy('date_submission', 'desc')->get();
    	$news = \App\News::orderBy('created_at', 'desc')->limit(3)->get();

        return view('dashboard.home.index', compact('tradePermit', 'news'));
    }
}
