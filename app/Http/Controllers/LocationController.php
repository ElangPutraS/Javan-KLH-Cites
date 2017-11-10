<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
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
}
