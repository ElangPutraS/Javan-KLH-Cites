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
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'asc')->paginate(10);

        return view('admin.news.index', compact('news'));
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

        return view('admin.news.create', compact('users', 'countries', 'provinces', 'cities'));
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
            'place_of_birth' => $request->get('place_birth'),
            'date_of_birth'  => $request->get('date_birth'),
            'address'        => $request->get('address'),
            'mobile'         => $request->get('mobile'),
            'country_id'     => $request->get('country_id'),
            'province_id'    => $request->get('province_id'),
            'city_id'        => $request->get('city_id'),
        ]);

        $user->userProfile()->save($user_profile);

        $company = new Company([
            'company_name' => $request->get('company_name'),
            'company_address' => $request->get('company_address'),
            'company_email' => $request->get('company_email'),
            'company_fax' => $request->get('company_fax'),
            'company_latitude' => $request->get('company_latitude'),
            'company_longitude' => $request->get('company_longitude'),
            'company_status' => $request->get('company_status'),
            'city_id' => $request->get('company_city_id'),
            'province_id' => $request->get('company_province_id'),
            'country_id' => $request->get('company_country_id'),
            'updated_by' => $request->user()->id,
        ]);

        $company->save();
        $company->userProfile()->associate($user_profile)->save();
        $company->user()->associate($user)->save();

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
            'company_name' => $request->get('company_name'),
            'company_address' => $request->get('company_address'),
            'company_email' => $request->get('company_email'),
            'company_fax' => $request->get('company_fax'),
            'company_latitude' => $request->get('company_latitude'),
            'company_longitude' => $request->get('company_longitude'),
            'company_status' => $request->get('company_status'),
            'city_id' => $request->get('company_city_id'),
            'province_id' => $request->get('company_province_id'),
            'country_id' => $request->get('company_country_id'),
            'updated_by' => $request->user()->id,
        ]);
        $user        = User::find($request->get('user_id'));
        $user->update([
            'name' => $request->name,
        ]);

        $user->userProfile()->update(
            [
                'place_of_birth' => $request->get('place_birth'),
                'date_of_birth' => $request->get('date_birth'),
                'mobile'        => $request->get('mobile'),
                'address'       => $request->get('address'),
                'city_id'       => $request->get('city_id'),
                'province_id'   => $request->get('province_id'),
                'country_id'   => $request->get('country_id'),
                'updated_by' => $request->user()->id,
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
