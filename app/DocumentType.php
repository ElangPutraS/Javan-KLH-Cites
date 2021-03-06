<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "document_type";

    protected $fillable = [
        'document_type_name',
        'is_permit',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_document')
            ->withPivot('document_name', 'file_path')
            ->using(CompanyDocument::class);
    }

    public function tradePermits()
    {
        return $this->belongsToMany(TradePermit::class, 'trade_permit_document')
            ->withPivot('document_name', 'file_path')
            ->using(TradePermitDocument::class);
    }
}
