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

    public function spesies(){
        return $this->belongsTo(Species::class);
    }
}
