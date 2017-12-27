<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pnbp extends Model
{
    protected $table = "pnbp";

    protected $fillable = [
        'pnbp_code',
        'payment_status',
        'pnbp_amount',
        'percentage_value',
        'pnbp_percentage_amount',
        'pnbp_sub_amount',
        'created_by',
        'updated_by',
        'trade_permit_id',
    ];

    public function tradePermit(){
        return $this->belongsTo(TradePermit::class);
    }

    public function history()
    {
        return $this->hasMany(HistoryPayment::class);
    }
}
