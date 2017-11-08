<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
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

    public function user_type_identify(){
        return $this->hasMany(User_Type_Identify::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
}
