<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'country_id',
        'province_code',
        'province_name',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class)
            ->withTrashed();
    }

    public function cities()
    {
        return $this->hasMany(City::class)
            ->withTrashed();
    }
}
