<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profile";

    protected $fillable = [
        'name', 'place_of_birth', 'date_of_birth', 'address', 'mobile', 'person_identify', 'users_id', 'city_id', 'user_type_identify_id', 'update_by',
    ];

    public function user(){
        return $this->belongsTo(User::Class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function typeIdentify(){
        return $this->belongsToMany(TypeIdentify::class,'user_type_identify');
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
}
