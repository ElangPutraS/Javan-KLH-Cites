<?php

namespace App\Http\Controllers\Admin;

use App\Company;
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
        if($request->input('company_name') == '' && $request->input('owner_name') == '' && $request->input('date_from') == '' && $request->input('date_until') == '' || $request->input('company_name') == null && $request->input('owner_name') == null && $request->input('date_from') == null && $request->input('date_until') == null){
            $companies = Company::orderBy('company_name', 'asc')->paginate(10);
        }else{
            $company_name = '%'.$request->input('company_name').'%';
            $owner_name = '%'.$request->input('owner_name').'%';

            if($request->input('date_from') != '' && $request->input('date_until') != ''){
                $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
                $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'))->addDays(1);

                $companies = Company::where('company_name', 'like', $company_name)
                    ->where('owner_name', 'like', $owner_name)
                    ->whereBetween('created_at', [$date_from , $date_until])
                    ->orderBy('company_name', 'asc')->paginate(10);
            }else {
                $date_from = '%'.$request->input('date_from').'%';
                $date_until = '%'.$request->input('date_until').'%';

                $companies = Company::where('company_name', 'like', $company_name)
                    ->where('owner_name', 'like', $owner_name)
                    ->whereDate('created_at', 'like', $date_from)
                    ->whereDate('created_at', 'like', $date_until)
                    ->orderBy('company_name', 'asc')->paginate(10);
            }
        }
        return view('admin.verification.index', compact('companies'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $company=Company::find($id);
        $company->update([
            'company_status' => 1
        ]);


        $company->user->notify(new VerificationCompany());



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
        //
    }

    public function updateRej(Request $request, $id)
    {
        $company=Company::find($id);
        $company->update([
            'company_status' => 2,
            'reject_reason' => $request->alasan,
        ]);

        $alasan = $request->get('alasan');

        $company->user->notify(new VerificationCompanyReject($alasan));

        return $company;
    }

}
