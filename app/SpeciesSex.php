<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeciesSex extends Model
{
    protected $table = "species_sex";

    protected $fillable = [
        'sex_code',
        'sex_name',
    ];

    public function species(){
        return $this->hasOne(Species::class);
    }
}
