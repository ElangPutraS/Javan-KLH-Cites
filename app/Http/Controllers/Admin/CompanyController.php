<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Company;
use App\Country;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Province;
use App\User;
use App\UserProfile;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('company_name', 'asc')->paginate(10);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities    = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');

        $users     = User::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.companies.create', compact('users', 'countries', 'provinces', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user_profile = new UserProfile([
            'place_of_birth' => $request->place_birth,
            'date_of_birth'  => $request->date_birth,
            'address'        => $request->address,
            'mobile'         => $request->mobile,
            'country_id'     => $request->nation,
            'province_id'    => $request->state,
            'city_id'        => $request->city,
        ]);

        $user->userProfile()->save($user_profile);

        $company = new Company([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_email' => $request->company_email,
            'company_fax' => $request->company_fax,
            'company_latitude' => $request->company_latitude,
            'company_longitude' => $request->company_longitude,
            'company_status' => $request->company_status,
            'city_id' => $request->company_city_id,
            'province_id' => $request->company_province_id,
            'country_id' => $request->company_country_id,
            'updated_by' => $request->user()->id,
        ]);

        $company->save();
        $company->userProfile()->associate($user_profile)->save();

        $role = Role::find(2);
        $user->roles()->attach($role);

        return redirect()->route('admin.companies.edit', $company)->with('success', 'Data berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities    = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');

        $users     = User::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.companies.edit', compact('company', 'users', 'countries', 'provinces', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_email' => $request->company_email,
            'company_fax' => $request->company_fax,
            'company_latitude' => $request->company_latitude,
            'company_longitude' => $request->company_longitude,
            'company_status' => $request->company_status,
            'city_id' => $request->company_city_id,
            'province_id' => $request->company_province_id,
            'country_id' => $request->company_country_id,
            'updated_by' => $request->user()->id,
        ]);
        $user        = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
        ]);

        $user->userProfile()->update(
            [
                'place_of_birth' => $request->place_birth,
                'date_of_birth' => $request->date_birth,
                'mobile'        => $request->mobile,
                'address'       => $request->address,
                'city_id'       => $request->city_id,
                'province_id'   => $request->province_id,
                'country_id'   => $request->country_id,
            ]
        );


        return redirect()->route('admin.companies.edit', $company)->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->user()->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Data berhasil dihapus.');
    }
}
