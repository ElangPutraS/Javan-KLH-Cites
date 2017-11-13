<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('role_name', $role)->first();
        }

        return $this->roles()->attach($role);
    }

    public function revokeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('role_name', $role)->first();
        }

        return $this->roles()->detach($role);
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if ($role->role_name === $name) return true;
        }

        return false;
    }
}
