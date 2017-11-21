<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class News extends Model
{
    protected $table = "news";

    protected $fillable = [
        'kategori',
        'judul',
        'isi',
        'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
