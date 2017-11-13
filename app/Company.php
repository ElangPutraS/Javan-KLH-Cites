<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";

    protected $fillable = [
        'company_name',
        'company_address',
        'company_email',
        'company_fax',
        'company_latitude',
        'company_longitude',
        'company_status',
        'user_profile_id',
        'country_id',
        'province_id',
        'city_id',
        'created_by',
        'updated_by',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function companyDocuments()
    {
        return $this->belongsToMany(DocumentType::class, 'company_document')
            ->withPivot('document_name', 'file_path')
            ->using(CompanyDocument::class);
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
}
