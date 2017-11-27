<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";

    protected $fillable = [
    	'country_code',
        'country_name',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

}

