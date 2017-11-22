<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table ="categories";

    protected $fillable=['species_category_code','species_category_name'];

    public function speciesCategory(){
        return $this->hasMany(Species::class);
    }
}
