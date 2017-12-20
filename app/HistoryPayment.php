<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPayment extends Model
{
    protected $table = "history_payment";

    protected $fillable = [
        'notes',
        'total_payment',
        'payment_method',
        'transaction_number',
        'pnbp_id',
        'pnbp_code',
        'log_trade_permit_id',
    ];

    public function pnbp()
    {
    	return $this->belongsTo(Pnbp::class);
    }

    public function tradeSpecies(){
        return $this->hasOne(LogTradePermit::class, 'log_trade_permit_id', 'id');
    }
}
