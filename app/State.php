<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "state";

    protected $fillable = [
        'state_name', 'nation_id'
    ];

    public function nation(){
        return $this->belongsTo(Nation::class);
    }

    public function city(){
        return $this->hasMany(City::class);
    }
}
