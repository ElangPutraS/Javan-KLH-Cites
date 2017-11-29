<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTradePermit extends Model
{
    protected $table = "log_trade_permit";

    protected $fillable = [
        'log_description',
    ];

    public function tradePermit() {
    	return $this->belongsTo(TradePermit::class, 'trade_permit_id', 'id');
    }
}
