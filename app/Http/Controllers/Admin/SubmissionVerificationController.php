<?php

namespace App\Http\Controllers\Admin;

use App\LogTradePermit;
use App\TradePermit;
use App\TradePermitStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionVerificationController extends Controller
{
    public function index()
    {
        $trade_permits = TradePermit::where('permit_type','1')->orderBy('date_submission', 'desc')->paginate(10);

        return view('admin.verificationSub.index', compact('trade_permits'));
    }

    public function show($id){
        $trade_permit = TradePermit::findOrFail($id);

        $user=User::findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationSub.detail', compact('trade_permit','user'));
    }

    public function update(Request $request, $id){
        $trade_permit=TradePermit::findOrFail($id);

        $valid_start=Carbon::now()->format('Y-m-d');
        $valid_until=Carbon::now()->addMonth($trade_permit->period)->format('Y-m-d');


        $trade_permit->update([
            'valid_start' => $valid_start,
            'valid_until' => $valid_until,
            'updated_by' => $request->user()->id
        ]);

        $status=TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => 'Verifikasi Permohonan Diterima',
        ]);
        $trade_permit->logTrade()->save($log);

        return redirect()->route('admin.verificationSub.index')->with('success', 'Permohonan berhasil diverifikasi.');
    }

    public function updateRej(Request $request, $id){
        $trade_permit=TradePermit::findOrFail($id);

        $trade_permit->update([
            'updated_by' => $request->user()->id
        ]);

        $status=TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => 'Verifikasi Permohonan Ditolak',
        ]);
        $trade_permit->logTrade()->save($log);

        return redirect()->route('admin.verificationSub.index')->with('success', 'Verifikasi Permohonan berhasil ditolak.');
    }


    //Verifikasi Renewal

    public function indexRen()
    {
        $trade_permits = TradePermit::where('permit_type','2')->orderBy('date_submission', 'desc')->paginate(10);

        return view('admin.verificationSub.index', compact('trade_permits'));
    }

    public function showRen($id){
        $trade_permit = TradePermit::findOrFail($id);

        $user=User::findOrFail($trade_permit->company->user_id);

        return view ('admin.verificationSub.detail', compact('trade_permit','user'));
    }

    public function updateRen(Request $request, $id){
        $trade_permit=TradePermit::findOrFail($id);

        $valid_start=Carbon::now()->format('Y-m-d');
        $valid_until=Carbon::now()->addMonth($trade_permit->period)->format('Y-m-d');


        $trade_permit->update([
            'valid_start' => $valid_start,
            'valid_until' => $valid_until,
            'updated_by' => $request->user()->id
        ]);

        $status=TradePermitStatus::where('status_code','200')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => 'Verifikasi Permohonan Diterima',
        ]);
        $trade_permit->logTrade()->save($log);

        return redirect()->route('admin.verificationSub.index')->with('success', 'Permohonan berhasil diverifikasi.');
    }

    public function updateRejectRen(Request $request, $id){
        $trade_permit=TradePermit::findOrFail($id);

        $trade_permit->update([
            'updated_by' => $request->user()->id
        ]);

        $status=TradePermitStatus::where('status_code','300')->first();
        $trade_permit->tradeStatus()->associate($status)->save();

        //nambahin log
        $log=LogTradePermit::create([
            'log_description' => 'Verifikasi Permohonan Ditolak',
        ]);
        $trade_permit->logTrade()->save($log);

        return redirect()->route('admin.verificationSub.index')->with('success', 'Verifikasi Permohonan berhasil ditolak.');
    }
}
