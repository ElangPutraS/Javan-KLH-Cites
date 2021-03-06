<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Notifications\ValidRegistration;
use App\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\VerificationCompany;
use App\Notifications\VerificationCompanyReject;

class UserVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company_name   = $request->input('company_name');
        $owner_name     = $request->input('owner_name');
        $date_from      = $request->input('date_from');
        $date_until     = $request->input('date_until');
        $status         = $request->input('status');

        $companies = Company::query();

        if($request->filled('company_name')){
            $companies = $companies->where('company_name', 'like', '%'.$company_name.'%');
        }

        if($request->filled('owner_name')){
            $companies = $companies->where('owner_name', 'like', '%'.$owner_name.'%');
        }

        if($request->filled('date_from') && $request->filled('date_until')){
            $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
            $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

            $companies = $companies->whereBetween('created_at', [$date_from, $date_until]);
        }else if (!$request->filled('date_from') && $request->filled('date_until')){
            $companies = $companies->whereDate('created_at', '=', $date_until);
        }else if ($request->filled('date_from') && !$request->filled('date_until')){
            $companies = $companies->whereDate('created_at', '=', $date_from);
        }

        if($request->filled('status')){
            $companies = $companies->where('company_status', $status);
        }

        $companies = $companies->orderBy('company_name', 'asc')->paginate(10);

        return view('admin.verification.index', compact('companies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company=Company::find($id);
        return view('admin.verification.detail', compact('company'));
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
        $company = Company::find($id);
        $company->update([
            'company_status' => 1
        ]);

        $company->user->notify(new ValidRegistration($company->user));

        $company->user->notify(new VerificationCompany($company));

        return redirect()->route('admin.verification.index')->with('success', 'Data berhasil diverifikasi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->user()->forceDelete();

        return redirect()->route('admin.verification.index')->with('success', 'Registrasi perusahaan berhasil ditolak.');
    }

    public function updateRej(Request $request)
    {
        $company = Company::find($request->get('id'));

        $company->user->notify(new ValidRegistration($company->user));

        $company_item = ['company_name' => $company->company_name, 'company_status' => $company->company_status, 'reject_reason' => $request->get('alasan')];
        $company->user->notify(new VerificationCompanyReject( $company_item ));

        return $company;
    }

}
