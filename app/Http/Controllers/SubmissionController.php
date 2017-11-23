<?php

namespace App\Http\Controllers;

use App\Company;
use App\DocumentType;
use App\LogTradePermit;
use App\Ports;
use App\PurposeType;
use App\Species;
use App\TradePermit;
use App\TradePermitStatus;
use App\TradingType;
use App\User;
use App\UserProfile;
use Auth;
use Illuminate\Http\Request;
use function Sodium\add;

class SubmissionController extends Controller
{
    public function index(){
        $trade_permits=TradePermit::orderBy('trade_permit_code', 'asc')->paginate(10);

        return view('pelakuusaha.submission.index', compact('trade_permits'));
    }

    public function showDirect(){
        $user=User::find(Auth::id());

        $trading_types=TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types=PurposeType::pluck('purpose_type_name', 'id');
        $ports=Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $document_types=DocumentType::where('is_permit',1)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');

        $species=Species::get();
        return view('pelakuusaha.submission.create', compact('user', 'trading_types', 'purpose_types', 'ports', 'document_types', 'species'));
    }

    public function showStage(){

    }

    public function storeDirect(Request $request){
        //isi trade permit
        $trade_permit = new TradePermit([
            'trade_permit_code'  => 'cek',
            'consignee'         => $request->get('consignee'),
            'appendix_type'     => $request->get('appendix_type'),
            'date_submission'   => date('Y-m-d'),
            'period'            => 6,
            'port_exportation'  => $request->get('port_exportation'),
            'port_destination'  => $request->get('port_destination'),
            'trading_type_id'  => $request->get('trading_type_id'),
            'purpose_type_id'  => $request->get('purpose_type_id'),
            'created_by'        => $request->user()->id,
        ]);
        $trade_permit->save();

        //relasi
        $company=Company::find($request->user()->company->id);
        $company->tradePermits()->save($trade_permit);

        //relasi status
        $status=TradePermitStatus::find(1);
        $trade_permit->tradeStatus()->associate($status);
        $trade_permit->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => $status->status_name,
        ]);
        $trade_permit->logTrade()->save($log);

        //save document trade permit
        if($request->document_trade_permit!=''){
            foreach ($request->document_trade_permit as $key => $file) {

                /**
                 * @var \Illuminate\Http\UploadedFile $file
                 */
                $file_path = $file->store('/upload/file/trade_document');

                $document_type = DocumentType::find($request->get('document_type_id')[$key]);

                $trade_permit->documentTypes()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
            }
        }

        //save spesimen trade permit
        foreach ($request->quantity as $key => $quantity) {

            /**
             * @var \Illuminate\Http\UploadedFile $file
             */
            $file_path = $file->store('/upload/file/trade_document');

            $species = Species::find($request->get('species_id')[$key]);

            $trade_permit->tradeSpecies()->attach($species, [
                'total_exported' => $quantity
            ]);
        }

        return redirect()->route('user.submission.index')->with('success', 'Data berhasil dibuat.');
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
