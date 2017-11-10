<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = "roles";

    protected $fillable = [
        'role_name',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_role');
    }
}
