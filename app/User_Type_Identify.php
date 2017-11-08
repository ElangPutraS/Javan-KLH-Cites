<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Type_Identify extends Model
{
    protected $table = "user_type_identify";

    protected $fillable = [
        'user_type_identify_name',
    ];

    public function user_profile(){
        return $this->belongsTo(User_Profile::class);
    }
}
