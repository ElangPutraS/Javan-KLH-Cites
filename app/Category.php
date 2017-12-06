<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table ="categories";

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable=['species_category_code','species_category_name'];

    public function species(){
        return $this->hasMany(Species::class)
            ->withTrashed();
    }
}