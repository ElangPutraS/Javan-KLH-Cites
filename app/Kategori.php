<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = "kategori";

    protected $fillable = ['species_kategori_kode', 'species_kategori_name'];
}
