<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ports extends Model
{
    //protected $table = "ports";
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'port_code',
        'port_name',
    ];
}
