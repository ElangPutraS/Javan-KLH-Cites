<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Storage;

class TradePermitDocument extends Pivot
{
    protected $table = "trade_permit_document";

    protected $fillable = [
        'document_name', 'trade_permit_id', 'document_type_id', 'file_path',
    ];

    public $appends = ['download_url'];

    public function getDownloadUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}
