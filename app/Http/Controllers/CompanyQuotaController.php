<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyQuotaController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->company;
        $companyQuota = $company->companyQuota()->orderBy('year','desc')->paginate(10);

        return view( 'pelakuusaha.companyQuota.index', compact('company', 'companyQuota'));
    }
}
