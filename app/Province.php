<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
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
        return $this->hasMany(City::class);
    }
}
