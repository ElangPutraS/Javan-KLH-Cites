<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = "species";

    protected $fillable = [
        'species_scientific_name',
        'species_indonesia_name',
        'species_general_name',
        'is_appendix',
        'appendix_source_id',
        'species_sex_id',
        'species_category_id',
        'nominal',
    ];

    public function speciesQuota(){
        return $this->hasMany(SpeciesQuota::class);
    }

    public function appendixSource(){
        return $this->belongsTo(AppendixSource::class);
    }

    public function speciesSex(){
        return $this->belongsTo(SpeciesSex::class);
    }

    public function tradeSpecies()
    {
        return $this->belongsToMany(TradePermit::class, 'trade_permit_detail')
            ->withPivot('total_exported');
    }
    public function speciesCategory(){
        return $this->belongsTo(Category::class);
    }
}
