<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Species;
use App\SpeciesQuota;
use App\AppendixSource;
use App\SpeciesSex;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpeciesQuotaRequest;
use App\Http\Requests\SpeciesQuotaUpdateRequest;

class SpeciesHSController extends Controller
{
    public function index(){
        $species=Species::orderBy('species_scientific_name', 'asc')->paginate(10);

        return view('admin.species.index', compact('species'));
    }

    public function create(){
    	$appendix=AppendixSource::orderBy('appendix_source_code', 'asc')->pluck('appendix_source_code', 'id');
    	$species_sex=SpeciesSex::orderBy('sex_name', 'asc')->pluck('sex_name', 'id');
    	$categories=Categories::orderBy('species_category_name')->pluck('species_category_name','id');
    	return view('admin.species.createspecies', compact('appendix', 'species_sex', 'categories'));
    }

    public function store(Request $request){
    	$species=new Species([
    		'species_scientific_name' => $request->get('scientific_name'),
    		'species_indonesia_name' => $request->get('indonesia_name'),
    		'species_general_name' => $request->get('general_name'),
    		'is_appendix' => $request->get('is_appendix'),
    		'species_sex_id' => $request->get('species_sex_id'),
    		'species_category_id' => $request->get('species_category_id'),
    		]);
    	$species->save();
    	if($request->get('is_appendix')!=0){
    		$appendix=AppendixSource::find($request->get('appendix_source_id'));
    		$species->appendixSource()->associate($appendix)->save();
    	}
    	return redirect()->route('admin.species.editSpecies', ['id' => $species->id])->with('success', 'Data berhasil ditambah.');
    }

    public function edit($id){
    	$species=Species::find($id);
    	$appendix=AppendixSource::orderBy('appendix_source_code', 'asc')->pluck('appendix_source_code', 'id');
    	$species_sex=SpeciesSex::orderBy('sex_name', 'asc')->pluck('sex_name', 'id');
        $categories=Categories::orderBy('species_category_name')->pluck('species_category_name','id');
    	return view('admin.species.editspecies', compact('species', 'appendix', 'species_sex','categories'));
    }

    public function update(Request $request, $id){
    	$species=Species::find($id);
    	$species->update([
    		'species_scientific_name' => $request->get('scientific_name'),
    		'species_indonesia_name' => $request->get('indonesia_name'),
    		'species_general_name' => $request->get('general_name'),
    		'is_appendix' => $request->get('is_appendix'),
    		'species_sex_id' => $request->get('species_sex_id'),
            'species_category_id' => $request->get('species_category_id'),
    		]);

    	if($request->get('is_appendix')!=0){
    		$appendix=AppendixSource::find($request->get('appendix_source_id'));
    		$species->appendixSource()->associate($appendix)->save();
    	}else{
    		$species->appendixSource()->dissociate()->save();
    	}
    	return redirect()->route('admin.species.editSpecies', ['id' => $species->id])->with('success', 'Data berhasil ditambah.');
    }

    public function destroy($id)
    {
    	$species=Species::find($id);

    	$species->delete();
    	SpeciesQuota::where('species_id', $id)->delete();

    	return redirect()->route('admin.species.index')->with('success', 'Data berhasil dihapus.');
    }

    public function showQuota($species_id){
        $species=Species::findOrFail($species_id);
        $quota=SpeciesQuota::where('species_id',$species_id)->paginate(10);
        return view('admin.species.showquota', compact('species', 'quota'));
    }

    public function createQuota($species_id){
        $species=Species::find($species_id);
        return view('admin.species.createquota', compact('species'));
    }

    public function storeQuota(SpeciesQuotaRequest $request, $species_id){
        $species=Species::find($species_id);
        $quota=new SpeciesQuota([
        	'year' => $request->year,
        	'quota_amount' => $request->quota_amount,
        	]);
        $quota->save();
        $species->speciesQuota()->save($quota);
        return redirect()->route('admin.species.editquota', ['species_id' => $species_id, 'id' => $quota->id])->with('success', 'Data berhasil ditambah.');
    }

    public function editQuota($species_id, $id){
        $species=Species::find($species_id);
        $quota=SpeciesQuota::find($id);
        return view('admin.species.editquota', compact('species', 'quota'));
    }

    public function updateQuota(SpeciesQuotaUpdateRequest $request, $species_id, $id){
        $quota=SpeciesQuota::find($id);
        $quota->update([
            'year' => $request->year,
            'quota_amount' => $request->quota_amount,
            ]);
        return redirect()->route('admin.species.editquota', ['species_id' => $species_id, 'id' => $id])->with('success', 'Data berhasil diubah.');
    }

    public function destroyQuota($species_id, $id)
    {
        $quota=SpeciesQuota::find($id);
        $quota->delete();

        return redirect()->route('admin.species.showquota', ['species_id' => $species_id])->with('success', 'Data berhasil dihapus.');
    }

    
}
