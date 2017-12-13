<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companyQuota extends Model
{
    protected $table = "company_quota";

    protected $fillable = [
        'company_id', 'species_id', 'quota_amount', 'realization', 'year',
    ];
}
