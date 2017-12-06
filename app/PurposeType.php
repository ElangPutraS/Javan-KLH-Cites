<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurposeType extends Model
{
    protected $table = "purpose_type";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'purpose_type_code',
        'purpose_type_name'
    ];
}
