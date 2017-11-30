<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pnbp extends Model
{
    protected $table = "pnbp";

    protected $fillable = [
        'pnbp_code',
        'pnbp_amount',
        'created_by',
        'updated_by',
        'trade_permit_id',
    ];

    public function tradePermit(){
        return $this->belongsTo(TradePermit::class);
    }
}
