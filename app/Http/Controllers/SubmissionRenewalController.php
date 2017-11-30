<?php

namespace App\Http\Controllers;

use App\TradePermit;
use Illuminate\Http\Request;
use App\DocumentType;
use App\Ports;
use App\PurposeType;
use App\TradingType;
use Carbon\Carbon;
use App\TradePermitStatus;
use App\LogTradePermit;

class SubmissionRenewalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trade_permits = TradePermit::whereHas('tradeStatus', function ($query) {
            $query->where('status_code', '>=', '600');
        })->orderBy('trade_permit_code', 'asc')->paginate(10);

        return view('pelakuusaha.renewals.index', compact('trade_permits'));
    }

    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $trading_types = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types = PurposeType::pluck('purpose_type_name', 'id');
        $ports = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $trade_permit = TradePermit::findOrFail($id);
        return view('pelakuusaha.renewals.edit', compact('user', 'trade_permit', 'trading_types', 'purpose_types', 'ports'));
    }

    public function update(Request $request, $id)
    {
        $trade_permit = TradePermit::findOrFail($id);

        $valid_start = $trade_permit->valid_until;
        $valid_until = Carbon::parse($valid_start)->addMonth($request->get('period'))->format('Y-m-d');

        $trade_permit->update([
            'period' => $request->get('period'),
            'consignee' => $request->get('consignee'),
            'port_exportation' => $request->get('port_exportation'),
            'port_destination' => $request->get('port_destination'),
            'valid_start' => $valid_start,
            'valid_until' => $valid_until,
            'valid_renewal' => $trade_permit->valid_renewal+1,
            'purpose_type_id' => $request->get('purpose_type_id')
        ]);

        if($request->document_trade_permit != ''){

                $file_path = $request->document_trade_permit->store('/upload/file/trade_document');

                $document_type = DocumentType::find($request->get('document_type_id'));

                $trade_permit->documentTypes()->attach($document_type, [
                    'document_name' => $request->document_trade_permit->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);

        }
        $status = TradePermitStatus::where('status_code', 100)->first();
        $trade_permit->tradeStatus()->associate($status);
        $trade_permit->save();


        $log = LogTradePermit::create([
            'log_description' => $status->status_name,
        ]);
        $trade_permit->logTrade()->save($log);



        return redirect()->route('user.renewal.edit', ['id' => $trade_permit->id])->with('success', 'Data berhasil diubah.');
    }

    public function getSubmission(Request $request){
        $trade_permit = TradePermit::where('trade_permit_code', $request->no)->first();
        if ($trade_permit){
            return($trade_permit->id);
        }
            return 0 ;
    }
}
