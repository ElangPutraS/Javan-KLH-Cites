<?php

namespace App\Http\Controllers;

use App\City;
use App\DocumentType;
use App\Province;
use App\Species;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvince($country){
        $province=Province::where('country_id',$country)->orderBy('province_name', 'asc')->get();
        return json_encode($province);
    }

    public function getCity($province){
        $city=City::where('province_id', $province)->orderBy('city_name_full', 'asc')->get();
        return json_encode($city);
    }

    public function getSpecies($syarat){
        $is_appendix='';
        if($syarat=='EA'){
            $is_appendix='1';
        }elseif($syarat=='EB'){
            $is_appendix='0';
        }
        $species=Species::where('is_appendix',$is_appendix)->orderBy('species_scientific_name','asc')
            ->with('appendixSource')
            ->with('speciesSex')
            ->with('speciesQuota')  
            ->get();

        return json_encode($species);
    }

    public function getDocumentReEkspor(){
        $document_type=DocumentType::where('is_permit', 3)->first();

        return json_encode($document_type);
    }

    public function getSpeciesComodity($comodity)
    {
        $species = Species::where('species_category_id', $comodity)->orderBy('species_scientific_name','asc')
                    ->with('unit')->get();

        return json_encode($species);
    }
}
