<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralValue extends Model
{
    //
    protected $table = 'general_value';

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'value'];
}
