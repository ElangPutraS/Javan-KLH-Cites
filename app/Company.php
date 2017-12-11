<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    protected $table = "companies";
    
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
        'country_id',
        'province_id',
        'city_id',
        'created_by',
        'updated_by',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class)
            ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    public function companyDocuments()
    {
        return $this->belongsToMany(DocumentType::class, 'company_document')
            ->withPivot('document_name', 'file_path')
            ->using(CompanyDocument::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)
            ->withTrashed();
    }

    public function province()
    {
        return $this->belongsTo(Province::class)
            ->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class)
            ->withTrashed();
    }

    public function tradePermits(){
        return $this->hasMany(TradePermit::class);
    }
}
