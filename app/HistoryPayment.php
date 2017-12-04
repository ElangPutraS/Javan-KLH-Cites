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
    ];

    public function pnbp()
    {
    	return $this->belongsTo(Pnbp::class);
    }
}
