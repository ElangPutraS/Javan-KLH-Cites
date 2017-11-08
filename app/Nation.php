<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    protected $table = "nation";

    protected $fillable = [
        'nation_name',
    ];

    public function state(){
        return $this->hasMany(State::class);
    }
}
