<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyQuota;
use Illuminate\Http\Request;

class CompanyQuotaController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->company;
        if($request->input('year') == '' && $request->input('scientific_name') == '' && $request->input('indonesia_name') == '' && $request->input('general_name') == '' || $request->input('year') == null && $request->input('scientific_name') == null && $request->input('indonesia_name') == null && $request->input('general_name') == null){
            $companyQuota = $company->companyQuota()->orderBy('year','desc')->paginate(10);
        }else{
            $year='%'.$request->input('year').'%';
            $scientific_name='%'.$request->input('scientific_name').'%';
            $indonesia_name='%'.$request->input('indonesia_name').'%';
            $general_name='%'.$request->input('general_name').'%';

            $companyQuota = $company->companyQuota()
                ->where('year', 'like', $year)
                ->where('species_scientific_name', 'like', $scientific_name)
                ->where('species_indonesia_name', 'like', $indonesia_name)
                ->where('species_general_name', 'like', $general_name)
                ->orderBy('year','desc')->paginate(10);
        }

        $years = CompanyQuota::select('year')->distinct()->get();

        return view( 'pelakuusaha.companyQuota.index', compact('company', 'companyQuota', 'years'));
    }
}
