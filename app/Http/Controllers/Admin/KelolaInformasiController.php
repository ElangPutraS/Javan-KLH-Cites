<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Company;
use App\Country;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelolaInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('company_name', 'asc')->paginate(10);

        return view('admin.kelolainformasi.index', compact('companies'));
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
        $cities    = City::orderBy('city_name', 'asc')->pluck('city_name', 'id');

        $users     = User::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.companies.create', compact('users', 'countries', 'provinces', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company();

        $company->fill($request->only(
            'company_name',
            'company_address',
            'company_email',
            'company_fax',
            'company_latitude',
            'company_longitude',
            'company_status',
            'city_id'
        ));

        $company->user()->associate($request->user());
        $company->save();

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
        $cities    = City::orderBy('city_name', 'asc')->pluck('city_name', 'id');

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
    public function update(Request $request, Company $company)
    {
        $company->fill($request->only(
            'company_name',
            'company_address',
            'company_email',
            'company_fax',
            'company_latitude',
            'company_longitude',
            'company_status',
            'city_id'
        ));

        $company->save();

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
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Data berhasil dihapus.');
    }
}
