<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "document_type";

    protected $fillable = [
        'document_type_name',
    ];

    public function company(){
        return $this->belongsToMany(Company::class, 'company_document')->withPivot('document_name','id');
    }
}
