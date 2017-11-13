<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'name',
        'place_of_birth',
        'date_of_birth',
        'address',
        'mobile',
        'person_identify',
        'users_id',
        'country_id',
        'province_id',
        'city_id',
        'user_type_identify_id',
        'update_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function typeIdentify()
    {
        return $this->belongsToMany(TypeIdentify::class, 'user_type_identify')
            ->withPivot('user_type_identify_number')
            ->using(UserTypeIdentify::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class)->withDefault();
    }
}
