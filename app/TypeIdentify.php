<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeIdentify extends Model
{
    protected $table = "type_identify";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type_identify_name',
    ];

    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'user_type_identify')
            ->withPivot('user_type_identify_number')
            ->using(UserTypeIdentify::class)
            ->withTrashed();
    }
}
