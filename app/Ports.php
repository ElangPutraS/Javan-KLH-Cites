<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ports extends Model
{
    protected $table = "ports";

    protected $fillable = [
        'port_code',
        'port_name',
    ];
}
