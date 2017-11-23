<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ="categories";

    protected $fillable=['species_category_code','species_category_name'];

    public function species(){
        return $this->hasMany(Species::class);
    }
}