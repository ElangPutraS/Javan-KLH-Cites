<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppendixSource extends Model
{
    protected $table = "appendix_source";

    protected $fillable = [
        'appendix_source_code',
        'description',
    ];

    public function species(){
        return $this->hasOne(Species::class);
    }
}
