<?php

namespace App\Http\Controllers;

use App\City;
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
            ->get();

        return json_encode($species);
    }
}
