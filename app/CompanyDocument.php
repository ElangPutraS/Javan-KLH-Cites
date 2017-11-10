<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Storage;

class CompanyDocument extends Pivot
{
    protected $table = "company_document";

    protected $fillable = [
        'company_document_name', 'company_id', 'document_type_id', 'file_path',
    ];

    public $appends = ['download_url'];

    public function getDownloadUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}
