<?php

namespace App\Http\Controllers;

use App\City;
use App\Company;
use App\CompanyDocument;
use App\Country;
use App\DocumentType;
use App\Http\Requests\ProfileUpdateRequest;
use App\Province;
use App\TypeIdentify;
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

    public function edit(Request $request)
    {
        $countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $provinces = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
        $cities    = City::orderBy('city_name_full', 'asc')->pluck('city_name_full', 'id');
        $document_type    = DocumentType::where('is_permit',0)->orderBy('document_type_name', 'asc')->pluck('document_type_name', 'id');
        $identity_type    = TypeIdentify::orderBy('type_identify_name', 'asc')->pluck('type_identify_name', 'id');

        $user    = $request->user();
        $company = $user->userProfile->company;

        return view('profile.edit', compact('user', 'countries', 'provinces', 'cities', 'document_type', 'identity_type', 'company'));
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $company = $user->company();

        $company->update([
            'company_name' => $request->get('company_name'),
            'company_address' => $request->get('company_address'),
            'company_email' => $request->get('company_email'),
            'company_fax' => $request->get('company_fax'),
            'company_latitude' => $request->get('company_latitude'),
            'company_longitude' => $request->get('company_longitude'),
            'city_id' => $request->get('company_city_id'),
            'province_id' => $request->get('company_province_id'),
            'country_id' => $request->get('company_country_id'),
            'updated_by' => $request->user()->id,
        ]);

        $user->update([
            'name' => $request->get('name'),
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
            ]
        );

        $userProfile = $user->userProfile;
        if($request->old_type_identify != $request->type_identify){
            $userProfile->typeIdentify()->detach($request->old_type_identify);

            $identity=TypeIdentify::find($request->type_identify);
            $userProfile->typeIdentify()->attach($identity, ['user_type_identify_number' => $request->identity_number]);
        }else{
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


        return redirect()->route('profile.edit')->with('success', 'Data berhasil diubah.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $company = $user->company();

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Data berhasil diubah.');
    }

    public function deleteDocument($type_id, $company_id, $document_name){
        $document=str_replace('%',' ', $document_name);
        $company=Company::find($company_id);
        $type=DocumentType::find($type_id);
        $company->companyDocuments()->wherePivot('document_name', $document)->detach($type);
        return 'berhasil';
    }
}
