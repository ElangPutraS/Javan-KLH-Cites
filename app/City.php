<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";

    protected $fillable = [
        'city_name', 'state_id',
    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function userProfile(){
        return $this->hasMany(UserProfile::class);
    }
}
