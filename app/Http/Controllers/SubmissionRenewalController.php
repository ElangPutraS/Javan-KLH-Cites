<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\SubmissionRenewalRequest;
use App\Notifications\SubmissionCreate;
use App\Pnbp;
use App\TradePermit;
use App\User;
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
    public function index(Request $request)
    {
        $code           = $request->input('code');
        $period        = $request->input('period');
        $status_search  = $request->input('status');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');

        $trade_permits = TradePermit::query();

        if($request->filled('code')){
            $trade_permits = $trade_permits->where('trade_permit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('period')){
            $trade_permits = $trade_permits->where('period', '=', $period);
        }

        if($request->filled('status')){
            $trade_permits = $trade_permits->where('trade_permit_status_id', '=', $status_search);
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
                            $query->where([['status_code', '=', '300'],['permit_type', '=', '2']])->orWhere('status_code', '>=', '600');
                        })->orderBy('created_at', 'desc')->paginate(10);

        $status = TradePermitStatus::orderBy('status_code')->get();
        return view('pelakuusaha.renewals.index', compact('trade_permits', 'status'));
    }

    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $trading_types = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types = PurposeType::pluck('purpose_type_name', 'id');
        $ports = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $trade_permit = TradePermit::findOrFail($id);
        $document_type = DocumentType::where('is_permit', '2')->pluck('document_type_name', 'id');

        return view('pelakuusaha.renewals.edit', compact('user', 'trade_permit', 'trading_types', 'purpose_types', 'ports', 'countries', 'document_type'));
    }

    public function update(SubmissionRenewalRequest $request, $id)
    {
        $trade_permit = TradePermit::findOrFail($id);
        if($request->get('is_renewal') == 1){
            $trade_permit->update([
                'valid_renewal'         => $trade_permit->valid_renewal+1,
                'is_renewal'            => $request->get('is_renewal'),
                'permit_type'           => '2',
                'is_blanko'             => $request->get('is_blanko'),
                'is_printed'            => 0,
                'stamp'                 => null,
            ]);
        }else {
            $trade_permit->update([
                'consignee_address'     => $request->get('consignee_address'),
                'consignee'             => $request->get('consignee'),
                'port_exportation'      => $request->get('port_exportation'),
                'port_destination'      => $request->get('port_destination'),
                'country_exportation'   => $request->get('country_exportation'),
                'country_destination'   => $request->get('country_destination'),
                'valid_renewal'         => $trade_permit->valid_renewal + 1,
                'is_renewal'            => $request->get('is_renewal'),
                'purpose_type_id'       => $request->get('purpose_type_id'),
                'permit_type'           => '2',
                'is_blanko'             => $request->get('is_blanko'),
                'is_printed'            => 0,
                'stamp'                 => null,
            ]);
        }

        if($request->document_trade_permit) {
            foreach ($request->document_trade_permit as $key => $file) {

                $file_path = $file->store('/upload/file/trade_document');

                $document_type = DocumentType::findOrFail($request->get('document_type_id')[$key]);

                $trade_permit->documentTypes()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
            }
        }

        $status = TradePermitStatus::where('status_code', 100)->first();
        $trade_permit->tradeStatus()->associate($status);
        $trade_permit->save();

        $log = LogTradePermit::create([
            'log_description'           => $status->status_name.' ( Pembaharuan Permohonan )',
            'trade_permit_code'         => $trade_permit->trade_permit_code,
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
            'valid_renewal'             => '2',
            'permit_type'               => $trade_permit->permit_type,
            'created_by'                => $request->user()->id,
            'is_blanko'                 => $trade_permit->is_blanko,
            'is_renewal'                => $trade_permit->is_renewal,
            'category_id'               => $trade_permit->category_id,
            'source_id'                 => $trade_permit->source_id,
            'country_destination'       => $trade_permit->country_destination,
            'country_exportation'       => $trade_permit->country_exportation,
            'consignee_address'         => $trade_permit->consignee_address,
            'is_printed'                => $trade_permit->is_print,
            'stamp'                     => $trade_permit->stamp,
        ]);
        $trade_permit->logTrade()->save($log);

        //Notif Untuk Admin
        $notif_for = User::find(1);
        $notif_for->notify( new SubmissionCreate(auth()->user(), $trade_permit));

        //Notif Untuk SuperAdmin
        $notif_for = User::find(2);
        $notif_for->notify( new SubmissionCreate(auth()->user(), $trade_permit));

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
