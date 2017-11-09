<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvince($country){
        $province=Province::where('country_id',$country)->get();
        return json_encode($province);
    }

    public function getCity($province){
        $city=City::where('province_id', $province)->get();
        return json_encode($city);
    }
}
