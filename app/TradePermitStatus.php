<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradePermitStatus extends Model
{
    protected $table = "trade_permit_status";

    protected $fillable = [
        'status_code',
        'status_name',
    ];

    public function tradePermit(){
        return $this->hasMany(TradePermit::class);
    }
}
