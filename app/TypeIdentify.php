<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeIdentify extends Model
{
    protected $table = "type_identify";

    protected $fillable = [
        'user_type_identify_name',
    ];

    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'user_type_identify')
            ->withPivot('user_type_identify_number')
            ->using(UserTypeIdentify::class);
    }
}
