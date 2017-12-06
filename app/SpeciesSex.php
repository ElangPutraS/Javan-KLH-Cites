<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeciesSex extends Model
{
    protected $table = "species_sex";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sex_code',
        'sex_name',
    ];

}