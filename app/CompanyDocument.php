<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    protected $table = "company_document";

    protected $fillable = [
        'company_document_name', 'company_id', 'document_type_id',
    ];
}
