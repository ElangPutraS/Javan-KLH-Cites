<?php

namespace App\Http\Controllers;

use App\Country;
use App\Pnbp;
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
            $query->where([['status_code', '=', '300'],['permit_type', '=', '2']])->orWhere('status_code', '>=', '600');
        })->orderBy('trade_permit_code', 'asc')->paginate(10);
        return view('pelakuusaha.renewals.index', compact('trade_permits'));
    }

    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $trading_types = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types = PurposeType::pluck('purpose_type_name', 'id');
        $ports = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $trade_permit = TradePermit::findOrFail($id);
        return view('pelakuusaha.renewals.edit', compact('user', 'trade_permit', 'trading_types', 'purpose_types', 'ports', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $trade_permit = TradePermit::findOrFail($id);
        if($request->get('is_renewal') == 1){
            $trade_permit->update([
                'valid_renewal'         => $trade_permit->valid_renewal+1,
                'is_renewal'            => $request->get('is_renewal'),
                'permit_type'           => '2',
                'is_blanko'             => $request->get('is_blanko')
            ]);
        }else {
            $trade_permit->update([
                'consignee_address' => $request->get('consignee_address'),
                'consignee' => $request->get('consignee'),
                'port_exportation' => $request->get('port_exportation'),
                'port_destination' => $request->get('port_destination'),
                'country_exportation' => $request->get('country_exportation'),
                'country_destination' => $request->get('country_destination'),
                'valid_renewal' => $trade_permit->valid_renewal + 1,
                'is_renewal' => $request->get('is_renewal'),
                'purpose_type_id' => $request->get('purpose_type_id'),
                'permit_type' => '2',
                'is_blanko' => $request->get('is_blanko')
            ]);
        }

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
            'log_description'           => $status->status_name.' ( Pembaharuan Permohonan )',
            'valid_start'               => $trade_permit->valid_start,
            'valid_until'               => $trade_permit->valid_until,
            'consignee'                 => $trade_permit->consignee,
            'appendix_type'             => $trade_permit->appendix_type,
            'date_submission'           => $trade_permit->date_submission,
            'period'                    => $trade_permit->period,
            'port_exportation'          => $trade_permit->port_exportation,
            'port_destination'          => $trade_permit->port_destination,
            'trading_type_id'           => $trade_permit->trading_type_id,
            'purpose_type_id'           => $trade_permit->purpose_type_id,
            'company_id'                => $trade_permit->company_id,
            'trade_permit_status_id'    => $trade_permit->trade_permit_status_id,
            'valid_renewal'             => $trade_permit->valid_renewal,
            'permit_type'               => $trade_permit->permit_type,
            'created_by'                => $request->user()->id,
            'is_blanko'                 => $trade_permit->is_blanko,
            'is_renewal'                => $trade_permit->is_renewal,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
        ]);
        $trade_permit->logTrade()->save($log);



        return redirect()->route('user.renewal.index', ['id' => $trade_permit->id])->with('success', 'Data pembaharuan permohonan berhasil diajukan.');
    }

    public function getSubmission(Request $request){
        $trade_permit = TradePermit::where('trade_permit_code', $request->no)->first();
        if ($trade_permit){
            return($trade_permit->id);
        }
            return 0 ;
    }
}
