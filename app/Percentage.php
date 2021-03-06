<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    //
    protected $table = 'percentage';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'value',
    ];
}
