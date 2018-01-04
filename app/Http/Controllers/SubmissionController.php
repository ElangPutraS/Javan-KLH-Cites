<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\DocumentType;
use App\Http\Requests\SubmissionDirectRequest;
use App\LogTradePermit;
use App\Ports;
use App\PurposeType;
use App\Species;
use App\TradePermit;
use App\TradePermitStatus;
use App\TradingType;
use App\Category;
use App\Source;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class SubmissionController extends Controller
{
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

        $trade_permits = $trade_permits->where('company_id', $request->user()->company->id)->orderBy('created_at', 'desc')->paginate(10);

        $status = TradePermitStatus::orderBy('status_code')->get();

        return view('pelakuusaha.submission.index', compact('trade_permits', 'status'));
    }


    public function detail(Request $request, $id)
    {
        $user           = $request->user();

        $trade_permit=TradePermit::findOrFail($id);

        return view('pelakuusaha.submission.detail', compact('user', 'trade_permit'));
    }

    public function create(Request $request)
    {
        $user           = $request->user();

        $trading_types  = TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types  = PurposeType::pluck('purpose_type_name', 'id');
        $ports          = Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $categories     = Category::orderBy('species_category_code', 'asc')->get();
        $sources        = Source::orderBy('source_code', 'asc')->get();
        $countries      = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $document_types = DocumentType::where('is_permit', 1)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');

        $jumlah_tradePermit = TradePermit::where([['company_id', $request->user()->company->id], ['date_submission', date('Y-m-d')]])->count();

        return view('pelakuusaha.submission.create', compact('user', 'trading_types', 'purpose_types', 'ports', 'categories', 'sources', 'document_types', 'jumlah_tradePermit', 'countries'));
    }

    public function store(SubmissionDirectRequest $request)
    {
        //isi trade permit
        $trade_permit = new TradePermit([
            'trade_permit_code'     => ' ',
            'consignee'             => $request->get('consignee'),
            'appendix_type'         => $request->get('appendix_type'),
            'date_submission'       => date('Y-m-d'),
            'period'                => 0,
            'port_exportation'      => $request->get('port_exportation'),
            'port_destination'      => $request->get('port_destination'),
            'category_id'           => $request->get('category_id'),
            'source_id'             => $request->get('source_id'),
            'consignee_address'     => $request->get('consignee_address'),
            'trading_type_id'       => $request->get('trading_type_id'),
            'purpose_type_id'       => $request->get('purpose_type_id'),
            'country_destination'   => $request->get('country_destination'),
            'country_exportation'   => $request->get('country_exportation'),
            'created_by'            => $request->user()->id,
        ]);
        $trade_permit->save();

        //relasi
        $company = $request->user()->company;
        $company->tradePermits()->save($trade_permit);

        //relasi status
        $status = TradePermitStatus::where('status_code', 100)->first();
        $trade_permit->tradeStatus()->associate($status);
        $trade_permit->save();

        $log=LogTradePermit::create([
            'log_description'           => $status->status_name,
            'trade_permit_code'         => $trade_permit->trade_permit_code,
            'consignee'                 => $request->get('consignee'),
            'appendix_type'             => $request->get('appendix_type'),
            'date_submission'           => date('Y-m-d'),
            'period'                    => 0,
            'port_exportation'          => $request->get('port_exportation'),
            'port_destination'          => $request->get('port_destination'),
            'consignee_address'         => $request->get('consignee_address'),
            'trading_type_id'           => $request->get('trading_type_id'),
            'purpose_type_id'           => $request->get('purpose_type_id'),
            'category_id'               => $request->get('category_id'),
            'source_id'                 => $request->get('source_id'),
            'country_destination'       => $request->get('country_destination'),
            'country_exportation'       => $request->get('country_exportation'),
            'trading_type_id'           => $request->get('trading_type_id'),
            'purpose_type_id'           => $request->get('purpose_type_id'),
            'company_id'                => $trade_permit->company_id,
            'trade_permit_status_id'    => $trade_permit->trade_permit_status_id,
            'created_by'                => $request->user()->id,
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
                'total_exported'        => $quantity,
                'log_trade_permit_id'   => $log->id,
                'description'           => $request->get('description')[$key],
                'company_id'            => $trade_permit->company_id,
                'year'                  => date('Y')
            ]);
        }

        return redirect()->route('user.submission.index')->with('success', 'Data berhasil dibuat.');
    }

    public function create_kode($id)
    {
        $kode = '';
        for($a = 5; $a>strlen($id); $a--){
            $kode.='0';
        }

        $kode .= $id;

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
