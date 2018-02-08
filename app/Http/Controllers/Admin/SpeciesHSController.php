<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\HistoryQuota;
use App\Source;
use App\Species;
use App\SpeciesQuota;
use App\AppendixSource;
use App\SpeciesSex;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpeciesRequest;
use App\Http\Requests\SpeciesQuotaRequest;
use App\Http\Requests\SpeciesQuotaUpdateRequest;

class SpeciesHSController extends Controller
{
    public function index(Request $request){
        $hs_code            = $request->input('hs_code');
        $sp_code            = $request->input('sp_code');
        $category           = $request->input('category');
        $scientific_name    = $request->input('scientific_name');
        $indonesia_name     = $request->input('indonesia_name');
        $general_name       = $request->input('general_name');

        $species = Species::query();

        if($request->filled('hs_code')){
            $species = $species->where('hs_code', 'like', '%'.$hs_code.'%');
        }

        if($request->filled('sp_code')){
            $species = $species->where('sp_code', 'like', '%'.$sp_code.'%');
        }

        if($request->filled('category')){
            $species = $species->whereHas('speciesCategory',  function ($q) use($category) {
                $q->where('species_category_name', 'like', '%'.$category.'%');
            });
        }

        if($request->filled('scientific_name')){
            $species = $species->where('species_scientific_name', 'like', '%'.$scientific_name.'%');
        }

        if($request->filled('indonesia_name')){
            $species = $species->where('species_indonesia_name', 'like', '%'.$indonesia_name.'%');
        }

        if($request->filled('general_name')){
            $species = $species->where('species_general_name', 'like', '%'.$general_name.'%');
        }

        $species = $species->orderBy('species_scientific_name', 'asc')->paginate(10);

        return view('admin.species.index', compact('species'));
    }

    public function create(){
    	$appendix = AppendixSource::orderBy('appendix_source_code', 'asc')->pluck('appendix_source_code', 'id');
    	$species_sex = SpeciesSex::orderBy('sex_name', 'asc')->pluck('sex_name', 'id');
    	$categories = Category::orderBy('species_category_name')->pluck('species_category_name','id');
        $sources = Source::orderBy('source_code', 'asc')->get();
        $units = Unit::orderBy('unit_code', 'asc')->get();
    	return view('admin.species.createspecies', compact('appendix', 'species_sex', 'categories','sources','units'));
    }

    public function store(SpeciesRequest $request){

        $nominal = str_replace('.', '', $request->get('nominal'));
    	$species = new Species([
    		'species_scientific_name' => $request->get('scientific_name'),
    		'species_indonesia_name' => $request->get('indonesia_name'),
    		'species_general_name' => $request->get('general_name'),
    		'is_appendix' => $request->get('is_appendix'),
    		'species_category_id' => $request->get('species_category_id'),
    		'nominal' => $nominal,
    		'hs_code' => $request->get('hs_code'),
    		'sp_code' => $request->get('sp_code'),
    		'unit_id' => $request->get('unit_id'),
    		'source_id' => $request->get('source_id'),
            'species_description' => $request->get('description')
    		]);
    	$species->save();
    	if($request->get('is_appendix')!=0){
    		$appendix=AppendixSource::find($request->get('appendix_source_id'));
    		$species->appendixSource()->associate($appendix)->save();
    	}
    	return redirect()->route('admin.species.editSpecies', ['id' => $species->id])->with('success', 'Data berhasil dibuat.');
    }

    public function edit($id){
    	$species = Species::find($id);
    	$appendix = AppendixSource::orderBy('appendix_source_code', 'asc')->pluck('appendix_source_code', 'id');
    	$species_sex = SpeciesSex::orderBy('sex_name', 'asc')->pluck('sex_name', 'id');
        $categories = Category::orderBy('species_category_name')->pluck('species_category_name','id');
        $sources = Source::orderBy('source_code', 'asc')->get();
        $units = Unit::orderBy('unit_code', 'asc')->get();
    	return view('admin.species.editspecies', compact('species', 'appendix', 'species_sex','categories','sources','units'));
    }

    public function update(SpeciesRequest $request, $id){
    	$species = Species::find($id);
        $nominal = str_replace('.', '', $request->get('nominal'));
    	$species->update([
    		'species_scientific_name' => $request->get('scientific_name'),
    		'species_indonesia_name' => $request->get('indonesia_name'),
    		'species_general_name' => $request->get('general_name'),
    		'is_appendix' => $request->get('is_appendix'),
    		'species_sex_id' => $request->get('species_sex_id'),
            'species_category_id' => $request->get('species_category_id'),
            'nominal' => $nominal,
            'hs_code' => $request->get('hs_code'),
    		'sp_code' => $request->get('sp_code'),
    		'unit_id' => $request->get('unit_id'),
    		'source_id' => $request->get('source_id'),
            'species_description' => $request->get('description')
        ]);

    	if($request->get('is_appendix')!=0){
    		$appendix=AppendixSource::find($request->get('appendix_source_id'));
    		$species->appendixSource()->associate($appendix)->save();
    	}else{
    		$species->appendixSource()->dissociate()->save();
    	}
    	return redirect()->route('admin.species.editSpecies', ['id' => $species->id])->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
    	$species = Species::find($id);

    	$species->delete();
    	SpeciesQuota::where('species_id', $id)->delete();

    	return redirect()->route('admin.species.index')->with('success', 'Data berhasil dihapus.');
    }

    public function showQuota($species_id){
        $species = Species::findOrFail($species_id);
        $quota = SpeciesQuota::where('species_id',$species_id)->orderBy('year','desc')->paginate(10);
        return view('admin.species.showquota', compact('species', 'quota'));
    }

    public function createQuota($species_id){
        $species = Species::find($species_id);
        return view('admin.species.createquota', compact('species'));
    }

    public function storeQuota(SpeciesQuotaRequest $request, $species_id){
        $species = Species::find($species_id);
        $quota = new SpeciesQuota([
        	'year' => $request->year,
        	'quota_amount' => $request->quota_amount,
        	]);
        $quota->save();
        $species->speciesQuota()->save($quota);
        return redirect()->route('admin.species.showquota', ['species_id' => $species_id])->with('success', 'Data berhasil dibuat.');
    }

    public function editQuota($species_id, $id){
        $species = Species::find($species_id);
        $quota = SpeciesQuota::find($id);
        return view('admin.species.editquota', compact('species', 'quota'));
    }

    public function updateQuota(SpeciesQuotaUpdateRequest $request, $species_id, $id){
        $quota = SpeciesQuota::find($id);

        $quota->update([
            'year' => $request->year,
            'quota_amount' => $request->quota_amount,
            ]);

        $note = '';
        if($request->get('quota_plus') != ''){
            $note='Penambahan kuota sebanyak '.+$request->get('quota_plus');
        }else if($request->get('quota_min') != ''){
            $note='Pengurangan kuota sebanyak '.+$request->get('quota_min');
        }

        HistoryQuota::create([
            'notes'             => $note,
            'total_quota'       => $quota->quota_amount,
            'species_quota_id'  => $quota->id,
            'created_by'        => $request->user()->id,
        ]);

        return redirect()->route('admin.species.showquota', ['species_id' => $species_id, 'id' => $id])->with('success', 'Data berhasil diubah.');
    }

    public function destroyQuota($species_id, $id)
    {
        $quota = SpeciesQuota::find($id);
        $quota->delete();

        return redirect()->route('admin.species.showquota', ['species_id' => $species_id])->with('success', 'Data berhasil dihapus.');
    }

    public function detail(Request $request, $id)
    {
        $user           = $request->user();

        $species = Species::findOrFail($id);
        $appendix = AppendixSource::orderBy('appendix_source_code', 'asc')->pluck('appendix_source_code', 'id');
        $species_sex = SpeciesSex::orderBy('sex_name', 'asc')->pluck('sex_name', 'id');
        $categories = Category::orderBy('species_category_name')->pluck('species_category_name','id');
        $sources = Source::orderBy('source_code', 'asc')->pluck('source_code', 'id');
        $units = Unit::orderBy('unit_description', 'asc')->pluck('unit_description', 'id');
        return view('admin.species.detail', compact('species', 'appendix', 'species_sex','categories','sources','units','user'));


    }

}
