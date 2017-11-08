<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getState($nation){
        $state=State::where('nation_id',$nation)->get();
        $data='<option value="">--Choose State--</option>';
        foreach ($state as $st){
            $data.='<option value="'.$st->id.'">'.$st->state_name.'</option>';
        }
        return $data;
    }

    public function getCity($state){
        $city=City::where('state_id',$state)->get();
        $data='<option value="">--Choose City--</option>';
        foreach ($city as $ct){
            $data.='<option value="'.$ct->id.'">'.$ct->city_name.'</option>';
        }
        return $data;
    }
}
