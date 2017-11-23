<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Company;
use App\Country;
use App\DocumentType;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Province;
use App\TypeIdentify;
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
        $countries        = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces        = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities           = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');
        $document_type    = DocumentType::orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $identity_type    = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');

        $users     = User::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.companies.create', compact('users', 'countries', 'provinces', 'cities', 'document_type', 'identity_type'));
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

        $type = TypeIdentify::find($request->get('type_identify'));
        $user_profile->typeIdentify()->attach($type, ['user_type_identify_number' =>$request->get('identity_number')]);

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

        if($request->company_file!=''){
            foreach ($request->company_file as $key => $file) {

                /**
                 * @var \Illuminate\Http\UploadedFile $file
                 */
                $file_path = $file->store('/upload/file');

                $document_type = DocumentType::find($request->get('document_type')[$key]);

                $company->companyDocuments()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
            }
        }

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
        $document_type    = DocumentType::orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $identity_type    = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');

        $users     = User::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.companies.edit', compact('company', 'users', 'countries', 'provinces', 'cities', 'document_type', 'identity_type'));
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

        if($request->old_type_identify != $request->type_identify){
            $userProfile = $company->userProfile;
            $userProfile->typeIdentify()->detach($request->old_type_identify);

            $identity=TypeIdentify::find($request->type_identify);
            $userProfile->typeIdentify()->attach($identity, ['user_type_identify_number' => $request->identity_number]);
        }else{
            $userProfile = $company->userProfile;
            $userProfile->typeIdentify()->updateExistingPivot($request->type_identify, ['user_type_identify_number' => $request->identity_number]);
        }


        if($request->company_file!=''){
            foreach ($request->company_file as $key => $file) {

                /**
                 * @var \Illuminate\Http\UploadedFile $file
                 */
                $file_path = $file->store('/upload/file');

                $document_type = DocumentType::find($request->get('document_type')[$key]);

                $company->companyDocuments()->attach($document_type, [
                    'document_name' => $file->getClientOriginalName(),
                    'file_path'     => $file_path
                ]);
            }
        }


        return redirect()->route('admin.companies.edit', $company)->with('success', 'Data berhasil diubah.');
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
