<?php

namespace App\Http\Controllers\Admin;

use App\Species;
use App\SpeciesQuota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpeciesHSController extends Controller
{
    public function index(){
        $species=Species::orderBy('species_scientific_name', 'asc')->paginate(10);

        return view('admin.species.index', compact('species'));
    }

    public function showQuota($id){
        $species=Species::find($id)->first();
        $quota=SpeciesQuota::where('species_id',$id)->paginate(10);
        return view('admin.species.showquota', compact('species', 'quota'));
    }
}
