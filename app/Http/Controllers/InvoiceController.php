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
        if($request->input('code') == '' && $request->input('period') == '' && $request->input('status') == '' && $request->input('date_from') == '' && $request->input('date_until') == '' || $request->input('code') == null && $request->input('period') == null && $request->input('status') == null && $request->input('date_from') == null && $request->input('date_until') == null ){
            $trade_permits = TradePermit::where('company_id', $request->user()->company->id)->whereHas('tradeStatus', function ($query) {
                $query->where('status_code', '200');
            })->orderBy('trade_permit_code', 'asc')->paginate(10);
        }else {
            $code = '%' . $request->input('code') . '%';
            $period = '%' . $request->input('period') . '%';

            if ($request->input('date_from') != '' && $request->input('date_until') != '') {
                $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
                $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

                $trade_permits = TradePermit::where([['company_id', '=', $request->user()->company->id], ['trade_permit_code', 'like', $code], ['period', 'like', $period]])
                    ->whereBetween('date_submission', [$date_from, $date_until])
                    ->whereHas('tradeStatus', function ($query) {
                        $query->where('status_code', '200');
                    })->orderBy('trade_permit_code', 'asc')->paginate(10);
            } else {
                $date_from = '%' . $request->input('date_from') . '%';
                $date_until = '%' . $request->input('date_until') . '%';

                $trade_permits = TradePermit::where('company_id', $request->user()->company->id)
                    ->where('trade_permit_code', 'like', $code)
                    ->where('period', 'like', $period)
                    ->whereDate('date_submission', 'like', $date_from)
                    ->whereDate('date_submission', 'like', $date_until)
                    ->whereHas('tradeStatus', function ($query) {
                        $query->where('status_code', '200');
                    })->orderBy('trade_permit_code', 'asc')->paginate(10);
            }
        }
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
