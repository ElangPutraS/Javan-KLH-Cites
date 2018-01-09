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
    public function index(Request $request)
    {
        $company_name = $request->input('company_name');

        $companies = Company::query();

        $companies = $companies->where('company_status','1');

        if($request->filled('company_name')){
            $companies = $companies->where('company_name', 'like', '%'.$company_name.'%');
        }

        $companies = $companies->orderBy('company_name', 'asc')->paginate(10);

        return view('admin.companyQuota.index', compact('companies'));
    }

    public function detail(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if($request->input('year') == '' && $request->input('scientific_name') == '' && $request->input('indonesia_name') == '' && $request->input('general_name') == '' || $request->input('year') == null && $request->input('scientific_name') == null && $request->input('indonesia_name') == null && $request->input('general_name') == null){
            $companyQuota = $company->companyQuota()->orderBy('year','desc')->paginate(10);
        }else{
            $year='%'.$request->input('year').'%';
            $scientific_name='%'.$request->input('scientific_name').'%';
            $indonesia_name='%'.$request->input('indonesia_name').'%';
            $general_name='%'.$request->input('general_name').'%';

            $companyQuota = $company->companyQuota()
                ->where('year', 'like', $year)
                ->where('species_scientific_name', 'like', $scientific_name)
                ->where('species_indonesia_name', 'like', $indonesia_name)
                ->where('species_general_name', 'like', $general_name)
                ->orderBy('year','desc')->paginate(10);
        }


        $years = CompanyQuota::select('year')->distinct()->get();

        return view( 'admin.companyQuota.detail', compact('company', 'companyQuota', 'years'));
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
        $spec = Species::findOrFail($quota->species_id)->speciesQuota->where('year', $quota->year)->first();
        $total = CompanyQuota::where('species_id',$quota->species_id)->sum('quota_amount');
        $quota_now = $spec->quota_amount - $total;

        $species = Species::orderBy('species_scientific_name','asc')->get();
        $categories = Category::orderBy('species_category_code')->get();

        return view( 'admin.companyQuota.edit', compact('quota', 'company', 'species', 'categories', 'quota_now'));
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

        return redirect()->route('admin.companyQuota.detail', ['id' => $company_id])->with('success', 'Data berhasil diubah.');
    }

    public function destroy($company_id, $pivot_id)
    {
        CompanyQuota::where('id', $pivot_id)->delete();

        return redirect()->route('admin.companyQuota.detail', ['id' => $company_id])->with('success', 'Data berhasil dihapus.');
    }
}
