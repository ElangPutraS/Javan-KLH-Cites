<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = "sources";

    protected $fillable = [
        'source_code',
        'source_description',
    ];

    public function sourceSpecies(){
        return $this->hasMany(Source::class);
    }

}
