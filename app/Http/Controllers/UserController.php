<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyDocument;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(Request $data)
    {
        $user    = User::find($data->user())->first();
        $company = Company::where('user_profile_id', $user->userProfile->id)->first();
        return view('profile.profile', compact('user', 'company'));
    }
}
