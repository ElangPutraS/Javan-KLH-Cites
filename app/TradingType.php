<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradingType extends Model
{
    protected $table = "trading_type";

    protected $fillable = [
        'trading_type_code',
        'trading_type_name',
    ];
}
