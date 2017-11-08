<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";

    protected $fillable = [
        'company_name', 'company_address', 'company_email', 'company_fax', 'company_latitude', 'company_longitude', 'company_status', 'user_profile_id', 'city_id', 'created_by', 'updated_by',
    ];

    public function user_profile(){
        return $this->belongsTo(User_Profile::class);
    }

    public function company_document(){
        return $this->hasMany(Company_Document::class);
    }
}
