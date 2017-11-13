<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";

    protected $fillable = [
        'company_name',
        'company_address',
        'company_email',
        'company_fax',
        'company_latitude',
        'company_longitude',
        'company_status',
        'reject_reason',
        'user_profile_id',
        'city_id',
        'created_by',
        'updated_by',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function companyDocuments()
    {
        return $this->belongsToMany(DocumentType::class, 'company_document')
            ->withPivot('document_name', 'file_path')
            ->using(CompanyDocument::class);
    }
}
