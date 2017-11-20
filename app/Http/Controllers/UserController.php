<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyDocument;
use App\DocumentType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user    = $request->user();
        $company = $user->userProfile->company;

        return view('profile.profile', compact('user', 'company'));
    }

    public function deleteDocument($type_id, $company_id, $document_name){
        $document=str_replace('%',' ', $document_name);
        $company=Company::find($company_id);
        $type=DocumentType::find($type_id);
        $company->companyDocuments()->wherePivot('document_name', $document)->detach($type);
        return 'berhasil';
    }
}
