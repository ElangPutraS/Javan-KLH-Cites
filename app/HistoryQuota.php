<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryQuota extends Model
{
    protected $table = "history_quota";

    protected $fillable = [
        'notes',
        'total_quota',
        'species_quota_id',
        'created_by',
    ];

    public function speciesQuota()
    {
        return $this->belongsTo(SpeciesQuota::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
