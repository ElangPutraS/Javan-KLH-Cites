<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeciesQuota extends Model
{
    protected $table = "species_quota";

    protected $fillable = [
        'quota_amount',
        'year',
        'species_id',
    ];

    public function species(){
        return $this->belongsTo(Species::class)
            ->withTrashed();
    }

    public function history()
    {
        return $this->hasMany(HistoryQuota::class);
    }
}
