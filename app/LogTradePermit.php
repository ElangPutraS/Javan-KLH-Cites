<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTradePermit extends Model
{
    protected $table = "log_trade_permit";

    protected $fillable = [
        'log_description',
    ];

    public function TradePermit(){
        return $this->belongsTo(TradePermit::class);
    }
}
