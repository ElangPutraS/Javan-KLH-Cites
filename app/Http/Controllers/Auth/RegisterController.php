<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Nation;
use App\User;
use App\Http\Controllers\Controller;
use App\User_Profile;
use App\User_Type_Identify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'place_birth' => 'required|string',
            'date_birth' => 'required',
            'city' => 'required',
            'address' => 'required|string',
            'mobile' => 'required',
            'identify_type' => 'required',
            'person_identify' => 'required',
            'company_name' => 'required|string',
            'company_email' => 'required|string|email|max:255',
            'company_city' => 'required',
            'company_address' => 'required|string',
            'company_fax' => 'required',
            'company_latitude' => 'required',
            'company_longitude' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user_profile= new User_Profile(['place_of_birth' => $data['place_birth'],
                                        'date_of_birth' => $data['date_birth'],
                                        'address' => $data['address'],
                                        'mobile' => $data['mobile'],
                                        'user_type_identify_id' => $data['identify_type'],
                                        'person_identify' => $data['person_identify'],
                                        'city_id' => $data['city'],
                                        'person_identify' => $data['person_identify'],
                                        ]);
        $user_profile->save();
        $user_profile->user()->associate($user_profile)->save();

        $company=new Company(['company_name' => $data['company_name'],
                            'company_address' => $data['company_address'],
                            'company_email' => $data['company_email'],
                            'company_fax' => $data['company_fax'],
                            'company_latitude' => $data['company_latitude'],
                            'company_longitude' => $data['company_longitude'],
                            'city_id' => $data['company_city'],
                            'created_by' => $user->id,
                            ]);
        $company->save();
        $company->user_profile()->associate($company)->save();

        return $user;
    }

    public function showRegistrationForm()
    {
        $nation=Nation::get();
        $user_type_identify=User_Type_Identify::get();
        return view('auth.register', compact('nation', 'user_type_identify'));
    }

}
