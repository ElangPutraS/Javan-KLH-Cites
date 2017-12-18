<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
    protected $table = "species";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'species_scientific_name',
        'species_indonesia_name',
        'species_general_name',
        'is_appendix',
        'appendix_source_id',
        'species_category_id',
        'nominal',
        'hs_code',
        'sp_code',
        'unit_id',
        'source_id',
        'species_description',
    ];

    public function speciesQuota(){
        return $this->hasMany(SpeciesQuota::class);
    }

    public function appendixSource(){
        return $this->belongsTo(AppendixSource::class);
    }

    public function speciesSex(){
        return $this->belongsTo(SpeciesSex::class)
            ->withTrashed();
    }

    public function tradeSpecies()
    {
        return $this->belongsToMany(TradePermit::class, 'trade_permit_detail')
            ->withPivot('total_exported', 'log_trade_permit_id', 'description', 'valid_renewal')
            ->withTrashed();
    }

    public function speciesCategory(){
        return $this->belongsTo(Category::class)
            ->withTrashed();
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function companyQuota()
    {
        return $this->belongsToMany(Company::class, 'company_quota')
            ->withPivot('id', 'quota_amount', 'realization', 'year')
            ->using(CompanyQuota::class);
    }

}
