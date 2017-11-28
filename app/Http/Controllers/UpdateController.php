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
class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelakuusaha.updates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find(Auth::id());

        $trading_types=TradingType::orderBy('trading_type_name', 'asc')->pluck('trading_type_name', 'id');
        $purpose_types=PurposeType::pluck('purpose_type_name', 'id');
        $ports=Ports::orderBy('port_name', 'asc')->pluck('port_name', 'id');
        $document_types=DocumentType::where('is_permit',1)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $trade_permit=TradePermit::find($id);
        return view('pelakuusaha.updates._form', compact('user', 'trade_permit','trading_types','purpose_types','ports'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSubmission(Request $request){
        $trade_permit=TradePermit::where('trade_permit_code',$request->no)->first();
        if (count($trade_permit)>0){
            return($trade_permit->id);
        }else{
            return 0 ;
        }
    }
}
