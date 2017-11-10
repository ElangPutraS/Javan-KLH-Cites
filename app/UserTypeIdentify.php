<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTypeIdentify extends Pivot
{
    protected $table = "user_type_identify";

    protected $fillable = [
        'user_type_identify_number',
    ];
}
