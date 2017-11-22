<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurposeType extends Model
{
    protected $table = "purpose_type";

    protected $fillable = [
        'purpose_type_code',
        'purpose_type_name'
    ];
}
