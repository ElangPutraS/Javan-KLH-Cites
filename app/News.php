<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $fillable = [
        'kategori',
        'judul',
        'isi',
        'user_id',
    ];

    public function usernames()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
