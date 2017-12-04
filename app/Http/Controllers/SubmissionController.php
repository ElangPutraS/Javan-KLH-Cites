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
use Illuminate\Http\Request;
use PDF;

class SubmissionController extends Controller
{
    public function index() {
        $trade_permits = TradePermit::orderBy('trade_permit_code', 'asc')->paginate(10);

        return view('pelakuusaha.submission.index', compact('trade_permits'));
    }


    public function printSatsln($id) {


        $pdf = PDF::loadView('pdf.satsln');
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
        //return view('pdf.satsln');
    }

    public function detail(Request $request, $id)
    {
        $user           = $request->user();


        $trading_types  = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types  = PurposeType::pluck('purpose_type_name', 'id');
        $ports          = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $document_types = DocumentType::where('is_permit', 1)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');

        $trade_permit=TradePermit::findOrFail($id);

        return view('pelakuusaha.submission.detail', compact('user', 'trade_permit'));
    }

    public function create(Request $request){

        $user           = $request->user();

        $trading_types  = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types  = PurposeType::pluck('purpose_type_name', 'id');
        $ports          = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $document_types = DocumentType::where('is_permit', 1)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');

        return view('pelakuusaha.submission.create', compact('user', 'trading_types', 'purpose_types', 'ports', 'document_types'));
    }

    public function store(Request $request){

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

        //susun kode trade permit
        $trade_permit->update([
            'trade_permit_code' => $this->create_kode($trade_permit->id),
        ]);

        //relasi
        $company = $request->user()->company;
        $company->tradePermits()->save($trade_permit);

        //relasi status
        $status = TradePermitStatus::where('status_code', 100)->first();
        $trade_permit->tradeStatus()->associate($status);
        $trade_permit->save();

        $log=LogTradePermit::create([
            'log_description'=>$status->status_name,
        ]);
        $trade_permit->logTrade()->save($log);

        //save document trade permit
        if($request->document_trade_permit != ''){
            foreach ($request->document_trade_permit as $key => $file) {

                /**
                 * @var \Illuminate\Http\UploadedFile $file
                 */
                $file_path = $file->store('/upload/file/trade_document');

                $document_type = DocumentType::findOrFail($request->get('document_type_id')[$key]);

                $trade_permit->documentTypes()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
            }
        }

        //save spesimen trade permit
        foreach ($request->quantity as $key => $quantity) {
            $species = Species::findOrFail($request->get('species_id')[$key]);

            $trade_permit->tradeSpecies()->attach($species, [
                'total_exported' => $quantity
            ]);
        }

        return redirect()->route('user.submission.index')->with('success', 'Data berhasil dibuat.');
    }

    public function create_kode($id){
        $kode = $id;

        $bulan = date('m');
        $month = "";
        switch ($bulan){
            case 1: $month = 'I';
                    break;
            case 2: $month = 'II';
                    break;
            case 3: $month = 'III';
                    break;
            case 4: $month = 'IV';
                    break;
            case 5: $month = 'V';
                    break;
            case 6: $month = 'VI';
                    break;
            case 7: $month = 'VII';
                    break;
            case 8: $month = 'VIII';
                    break;
            case 9: $month = 'IX';
                    break;
            case 10: $month = 'X';
                    break;
            case 11: $month = 'XI';
                    break;
            case 12: $month = 'XII';
                    break;
        }

        $kode .= '/'.$month.'/SATS-LN/'.date('Y');


        return $kode;
    }
}
