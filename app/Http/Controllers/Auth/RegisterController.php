<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\Company;
use App\Country;
use App\DocumentType;
use App\Province;
use App\Role;
use App\TypeIdentify;
use App\User;
use App\Http\Controllers\Controller;
use App\UserProfile;
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
    protected $redirectTo = '/dashboard';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $date=date('Y-m-d');
        return Validator::make($data, [
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:6|confirmed',
            'place_birth'       => 'required|string',
            'date_birth'        => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'nation'            => 'required',
            'address'           => 'required|string',
            'mobile'            => 'required|numeric',
            'identify_type'     => 'required',
            'person_identify'   => 'required|numeric',
            'company_name'      => 'required|string',
            'company_email'     => 'required|string|email|max:255',
            'company_city'      => 'required',
            'company_state'      => 'required',
            'company_nation'      => 'required',
            'company_address'   => 'required|string',
            'company_fax'       => 'required|numeric',
            'company_latitude'  => 'required',
            'company_longitude' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /**
         * @var User $user
         */
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user_profile = new UserProfile([
            'place_of_birth' => $data['place_birth'],
            'date_of_birth'  => $data['date_birth'],
            'address'        => $data['address'],
            'mobile'         => $data['mobile'],
            'country_id'     => $data['nation'],
            'province_id'    => $data['state'],
            'city_id'        => $data['city'],
        ]);

        $user->userProfile()->save($user_profile);

        $type = TypeIdentify::find($data['identify_type']);
        $user_profile->typeIdentify()->attach($type, ['user_type_identify_number' => $data['person_identify']]);

        $company = new Company([
            'company_name'      => $data['company_name'],
            'company_address'   => $data['company_address'],
            'company_email'     => $data['company_email'],
            'company_fax'       => $data['company_fax'],
            'company_latitude'  => $data['company_latitude'],
            'company_longitude' => $data['company_longitude'],
            'country_id'         => $data['company_nation'],
            'province_id'       => $data['company_state'],
            'city_id'           => $data['company_city'],
            'created_by'        => $user->id,
        ]);

        $company->save();
        $company->userProfile()->associate($user_profile)->save();

        $company->user()->associate($user)->save();

        foreach ($data['company_file'] as $key => $file) {

            /**
             * @var \Illuminate\Http\UploadedFile $file
             */
            $file_path = $file->store('/upload/file');

            $document_type = DocumentType::find($data['document_type'][$key]);

            $company->companyDocuments()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
        }

        $role = Role::find(2);
        $user->roles()->attach($role);

        return $user;
    }

    public function showRegistrationForm()
    {
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities    = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');
        $user_type_identify = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');
        $document_type      = DocumentType::where('is_permit','0')->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');

        return view('auth.register', compact('countries', 'provinces', 'cities', 'user_type_identify', 'document_type'));
    }

}
