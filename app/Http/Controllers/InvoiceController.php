<?php

namespace App\Http\Controllers;

use App\TradePermitStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\TradePermit;
use PDF;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $code           = $request->input('code');
        $period        = $request->input('period');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $trade_permits = TradePermit::query();

        if($request->filled('code')){
            $trade_permits = $trade_permits->where('trade_permit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('period')){
            $trade_permits = $trade_permits->where('period', '=', $period);
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

        $trade_permits = $trade_permits->where('company_id', $request->user()->company->id)->whereHas('tradeStatus', function ($query) {
                            $query->where('status_code', '200');
                        })->orderBy('trade_permit_code', 'asc')->paginate(10);

        $status = TradePermitStatus::orderBy('status_code')->get();
        return view('pelakuusaha.invoice.index', compact('trade_permits', 'status'));
    }

    public function show(Request $request, $id)
    {
        $user			= $request->user();
        $trade_permit 	= TradePermit::with(['pnbp'])->where('id', '=', $id)->first();

        return view('pelakuusaha.invoice.detail', compact('trade_permit', 'user'));
    }
}
