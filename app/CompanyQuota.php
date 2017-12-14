<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyQuota extends Pivot
{
    protected $table = "company_quota";

    protected $fillable = [
        'id','company_id', 'species_id', 'quota_amount', 'realization', 'year',
    ];
}
