<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PnbpUpdateRequest;
use App\Pnbp;
use App\TradePermit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PnbpController extends Controller
{

    public function index()
    {
        $trade_permits = TradePermit::whereHas('tradeStatus', function ($query) {
            $query->where('status_code', '>=', '600');
        })->orderBy('trade_permit_code', 'asc')->paginate(10);

        return view('admin.pnbp.index', compact('trade_permits'));
    }

    public function edit($id)
    {
        $trade_permit   =   TradePermit::findOrFail($id);
        $user           =   User::findOrFail($trade_permit->company->user_id);

        return view('admin.pnbp.edit', compact('trade_permit', 'user'));
    }

    public function update(PnbpUpdateRequest $request, $id)
    {
        $trade_permit = TradePermit::findOrFail($id);

        if($trade_permit->pnbp === null){
            $pnbp=new Pnbp([
                'pnbp_code'     => '',
                'pnbp_amount'   => $request->get('pnbp_amount'),
                'created_by'    => $request->user()->id,
                'updated_by'    => $request->user()->id,
            ]);
            $pnbp->save();
            $pnbp->pnbp_code = $this->getCode($pnbp->id);
            $trade_permit->pnbp()->save($pnbp);
        }else{
            $trade_permit->pnbp()->update([
                'pnbp_amount'   => $request->get('pnbp_amount'),
                'created_by'    => $request->user()->id,
                'updated_by'    => $request->user()->id,
            ]);
        }

        return redirect()->route('admin.pnbp.index')->with('success', 'Data berhasil diubah.');
    }

    public function getCode($id){
        $kode = $id;

        $bulan = date('m');
        $month = "";
        switch ($bulan){
            case 1: $month='I';
                    break;
            case 2: $month='II';
                    break;
            case 3: $month='III';
                    break;
            case 4: $month='IV';
                    break;
            case 5: $month='V';
                    break;
            case 6: $month='VI';
                    break;
            case 7: $month='VII';
                    break;
            case 8: $month='VIII';
                    break;
            case 9: $month='IX';
                    break;
            case 10: $month='X';
                    break;
            case 11: $month='XI';
                    break;
            case 12: $month='XII';
                    break;
        }

        $kode.='/PNBP/'.$month.'-'.date('Y');

        return $kode;
    }

}
