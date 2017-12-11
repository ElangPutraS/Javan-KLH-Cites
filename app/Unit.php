<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "unit";

    protected $fillable = [
        'unit_code',
        'unit_description',
    ];

    public function unitSpecies(){
        return $this->hasOne(Unit::class);
    }
}
