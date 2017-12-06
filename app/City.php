<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = "cities";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'city_code',
        'city_name',
        'city_name_full',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class)
            ->withTrashed();
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, UserProfile::class)
            ->withTrashed();
    }
}
