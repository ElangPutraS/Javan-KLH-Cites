<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getState($nation){
        $state=State::where('nation_id',$nation)->get();
        return json_encode($state);
    }

    public function getCity($state){
        $city=City::where('state_id', $state)->get();
        return json_encode($city);
    }
}
