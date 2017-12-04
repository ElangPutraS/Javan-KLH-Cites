<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TradePermit;
use App\User;

class InvoiceController extends Controller
{
    public function index()
    {
    	$trade_permits = TradePermit::whereHas('tradeStatus', function ($query) {
            				$query->where('status_code', '200');
        				})->orderBy('trade_permit_code', 'asc')->paginate(10);

    	return view('pelakuusaha.invoice.index', compact('trade_permits'));
    }

    public function show(Request $request, $id)
    {
    	$user			= $request->user();
    	$trade_permit 	= TradePermit::findOrFail($id);

    	return view('pelakuusaha.invoice.detail', compact('trade_permit', 'user'));
    }
}
