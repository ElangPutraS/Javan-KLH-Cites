<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = "sources";

    protected $fillable = [
        'source_code',
        'source_description',
    ];
}
