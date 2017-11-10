<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyDocument;
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
}
