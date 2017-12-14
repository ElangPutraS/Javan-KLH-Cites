<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Company;
use App\CompanyQuota;
use App\Http\Requests\CompanyQuotaStoreRequest;
use App\Http\Requests\CompanyQuotaUpdateRequest;
use App\Species;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyQuotaController extends Controller
{
    public function index()
    {
        $companies = Company::where('company_status','1')->orderBy('company_name', 'asc')->paginate(10);

        return view('admin.companyQuota.index', compact('companies'));
    }

    public function detail($id)
    {
        $company = Company::findOrFail($id);
        $companyQuota = Company::findOrFail($id)->companyQuota()->orderBy('year','desc')->paginate(10);

        return view( 'admin.companyQuota.detail', compact('company', 'companyQuota'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        $species = Species::orderBy('species_scientific_name','asc')->get();
        $categories = Category::orderBy('species_category_code')->get();

        return view( 'admin.companyQuota.create', compact('company', 'species', 'categories'));
    }

    public function store(CompanyQuotaStoreRequest $request, $id){
        $company = Company::findOrFail($id);

        $species = Species::findOrFail($request->get('species_id'));

        $company->companyQuota()->attach($species, [
            'quota_amount'    => $request->get('quota_amount'),
            'realization'     => '0',
            'year'            => $request->get('year')
        ]);

        return redirect()->route('admin.companyQuota.detail', ['id' => $id])->with('success', 'Data berhasil dibuat.');
    }

    public function edit($company_id, $id)
    {
        $quota = CompanyQuota::find($id);
        $company = Company::findOrFail($company_id);

        $species = Species::orderBy('species_scientific_name','asc')->get();
        $categories = Category::orderBy('species_category_code')->get();

        return view( 'admin.companyQuota.edit', compact('quota', 'company', 'species', 'categories'));
    }

    public function update(CompanyQuotaUpdateRequest $request, $company_id, $id){
        $company = Company::find($company_id);

        $kuota = $company->companyQuota()->first();
        $kuota->pivot->where('id', $id)->update([
            'species_id'   => $request->get('species_id'),
            'quota_amount' => $request->get('quota_amount'),
            'realization'  => $request->get('realization'),
            'year'         => $request->get('year'),
        ]);
        //dd($request->get('quota_amount').' / '.$request->get('realization').' / '.$request->get('year'));
        /*$kuota->pivot->quota_amount = $request->get('quota_amount');
        $kuota->pivot->realization = $request->get('realization');
        $kuota->pivot->year = $request->get('year');
        $kuota->save();*/



        return redirect()->route('admin.companyQuota.detail', ['id' => $company_id])->with('success', 'Data berhasil diubah.');
    }

    public function destroy($company_id, $pivot_id)
    {
        CompanyQuota::where('id', $pivot_id)->delete();

        return redirect()->route('admin.companyQuota.detail', ['id' => $company_id])->with('success', 'Data berhasil dihapus.');
    }
}
