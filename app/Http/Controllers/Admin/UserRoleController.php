<?php

namespace App\Http\Controllers\admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\Province;
use App\TypeIdentify;
use App\City;
use App\DocumentType;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\UserProfile;
use App\Company;
use Illuminate\Support\Facades\Hash;


class UserRoleController extends Controller
{
    public function index(Request $request ){
        $name  = $request->input('name');
        $email = $request->input('email');
        $role  = $request->input('role');

        $users = User::query();

        if($request->filled('name')){
            $users = $users->where('name', 'like', '%'.$name.'%');
        }

        if($request->filled('email')){
            $users = $users->where('email', 'like', '%'.$email.'%');
        }

        if($request->filled('role')){
            $users = $users->whereHas('roles', function ($query) use($role) {
                        $query->where('id', $role);
                    });
        }

        $users = $users->withTrashed()->orderBy('name','asc')->paginate(10);

        $roles = Role::orderBy('role_name', 'asc')->get();
        return view('superadmin.index', compact('users', 'roles'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.index')->with('success', 'Data berhasil dihapus.');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();

        return redirect()->route('superadmin.index')->with('success', 'Data berhasil diaktifkan kembali.');
    }
    public function create()
    {
        $countries        = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces        = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities           = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');
        $document_type    = DocumentType::where('is_permit',0)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $identity_type    = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');
        //$users            = User::orderBy('name', 'asc')->pluck('name', 'id');
        $roles            = Role::orderBy('role_name', 'asc')->pluck('role_name', 'id');

        return view('superadmin.create', compact( 'countries', 'provinces', 'cities', 'document_type', 'identity_type','roles'));
    }

    public function store(CompanyStoreRequest $request)
    {
    if ($request->get('role_name') == 2){
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
            'npwp_number'    => $request->get('npwp_number_user'),
            'created_by'     => $request->user()->id,
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
            'created_by' => $request->user()->id,
            'owner_name' => $request->get('owner_name'),
            'captivity_address' => $request->get('captivity_address'),
            'labor_total' => $request->get('labor_total'),
            'investation_total' => str_replace( '.', '',$request->get('investation_total')),
            'npwp_number' => $request->get('npwp_number'),
            'date_distribution' => $request->get('date_distribution'),
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

        $user->roles()->sync($request->role_name);
    }else{
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->sync($request->role_name);
    }


        return redirect()->route('superadmin.editUser', ['id' => $user->id])->with('success', 'Data berhasil dibuat.');
    }
    public function edit($id)
    {
        $user     = User::findOrFail($id);
        $company = $user->company;
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities    = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');
        $document_type    = DocumentType::where('is_permit',0)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $identity_type    = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');


        $roles            = Role::orderBy('role_name', 'asc')->pluck('role_name', 'id');

        return view('superadmin.edit', compact('company', 'user', 'countries', 'provinces', 'cities', 'document_type', 'identity_type','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        $user        = User::findOrFail($id);
        $company     = $user->company;

        if ($request->get('old_password') && $request->get('new_password') && $request->get('confirm_password') !== NULL){
            if (!Hash::check($request->get('old_password'), $user->password)) {
                return redirect()->route('superadmin.editUser', ['id' => $id])->with('warning', 'Password Tidak sama');
            }
            else{
                $user->update([
                    'password' => bcrypt($request->get('new_password')),
                ]);
            }
        }

            if ($request->get('role_name') == 2) {
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
                    'owner_name' => $request->get('owner_name'),
                    'captivity_address' => $request->get('captivity_address'),
                    'labor_total' => $request->get('labor_total'),
                    'investation_total' => str_replace( '.', '',$request->get('investation_total')),
                    'npwp_number' => $request->get('npwp_number'),
                    'date_distribution' => $request->get('date_distribution'),
                ]);

                $user->update([
                    'name' => $request->name,
                    'email' => $request->get('email'),
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
                        'npwp_number'    => $request->get('npwp_number_user'),
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

                $user->roles()->sync($request->role_name);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                $user->roles()->sync($request->role_name);

            }

            return redirect()->route('superadmin.editUser', ['id' => $id])->with('success', 'Data berhasil diubah.');

    }

    public function storeUser(Request $request){
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('superadmin.editUser', ['id' => $user->id])->with('success', 'Data berhasil dibuat.');
    }

}
