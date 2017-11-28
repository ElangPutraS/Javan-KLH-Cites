<?php

namespace App\Http\Controllers\Admin;

use App\TradePermit;
use App\TradePermitStatus;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionVerificationController extends Controller
{
    public function index()
    {
        $trade_permits = TradePermit::orderBy('date_submission', 'asc')->paginate(10);

        return view('admin.verificationSub.index', compact('trade_permits'));
    }

    public function show($id){
        $trade_permit = TradePermit::find($id);

        $user=User::find($trade_permit->company->user_id);

        return view ('admin.verificationSub.detail', compact('trade_permit','user'));
    }

    public function update($id){
        $trade_permit=TradePermit::find($id);

        $valid_start=date('Y-m-d');
        $tambah=mktime(0,0,0,date('m')+$trade_permit->period,date('d')+0,date('Y')+0);
        $valid_until=date('Y-m-d', $tambah);


        $trade_permit->update([
            'valid_start' => $valid_start,
            'valid_until' => $valid_until,
            'updated_by' => Auth::user()->id
        ]);

        $status=TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        return redirect()->route('admin.verificationSub.index')->with('success', 'Permohonan berhasil diverivikasi.');
    }

    public function updateRej($id){
        $trade_permit=TradePermit::find($id);

        $trade_permit->update([
            'updated_by' => Auth::user()->id
        ]);

        $status=TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        return redirect()->route('admin.verificationSub.index')->with('success', 'Verifikasi Permohonan berhasil ditolak.');
    }
}
