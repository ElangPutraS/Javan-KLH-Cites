<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypeIdentify extends Model
{
    protected $table = "user_type_identify";

    protected $fillable = [
        'user_type_identify_number',
    ];
}
