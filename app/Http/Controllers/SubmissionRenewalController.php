<?php

namespace App\Http\Controllers;

use App\TradePermit;
use Illuminate\Http\Request;
use App\DocumentType;
use App\Ports;
use App\PurposeType;
use App\TradingType;
use App\User;
use Auth;
class SubmissionRenewalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trade_permits=TradePermit::whereHas('tradeStatus', function ($query) {
            $query->where('status_code', '>=', '600');
        })->orderBy('trade_permit_code', 'asc')->paginate(10);

        return view('pelakuusaha.renewals.index', compact('trade_permits'));
    }

    public function edit(Request $request, $id)
    {
        $user=$request->user();
        $trading_types=TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types=PurposeType::pluck('purpose_type_name', 'id');
        $ports=Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $trade_permit=TradePermit::findOrFail($id);
        return view('pelakuusaha.renewals.edit', compact('user', 'trade_permit','trading_types','purpose_types','ports'));
    }

    public function update(Request $request, $id)
    {
        $trade_permit=TradePermit::findOrFail($id);
        $trade_permit->update([
            'consignee'=>$request->get('cogsinee'),
            'appendix_type'=>$request->get('appendix_type'),
            'period'=>$request->get('period'),
            'consignee'=>$request->get('consignee'),
            'port_exportation'=>$request->get('port_exportation'),
            'port_destination'=>$request->get('port_destination'),
            'trading_type_id'=>$request->get('trading_type_id'),
            'purpose_type_id' =>$request->get('purpose_type_id')
        ]);

        if($request->document_trade_permit!=''){

                $file_path =$request->document_trade_permit->store('/upload/file/trade_document');

                $document_type = DocumentType::find($request->get('document_type_id'));

                $trade_permit->documentTypes()->attach($document_type, [
                    'document_name' => $request->document_trade_permit->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);

        }
        return redirect()->route('user.renewal.edit', ['id' => $trade_permit->id])->with('success', 'Data berhasil diubah.');
    }

    public function getSubmission(Request $request){
        $trade_permit=TradePermit::where('trade_permit_code',$request->no)->first();
        if ($trade_permit){
            return($trade_permit->id);
        }
            return 0 ;
    }
}
