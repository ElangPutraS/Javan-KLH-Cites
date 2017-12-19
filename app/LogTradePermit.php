<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTradePermit extends Model
{
    protected $table = "log_trade_permit";

    protected $fillable = [
        'trade_permit_id',
        'log_description',
        'consignee',
        'date_submission',
        'period',
        'valid_start',
        'valid_until',
        'company_id',
        'port_exportation',
        'port_destination',
        'trading_type_id',
        'purpose_type_id',
        'trade_permit_status_id',
        'created_by',
        'valid_renewal',
        'permit_type',
        'consignee_address',
        'category_id',
        'source_id',
        'country_destination',
        'country_exportation',
    ];


    public function tradePermit() {
    	return $this->belongsTo(TradePermit::class, 'trade_permit_id', 'id');

    }

    public function tradingType(){
        return $this->belongsTo(TradingType::class);
    }

    public function purposeType(){
        return $this->belongsTo(PurposeType::class)
            ->withTrashed();
    }

    public function tradeStatus(){
        return $this->belongsTo(TradePermitStatus::class, 'trade_permit_status_id');
    }

    public function portExpor(){
        return $this->belongsTo(Ports::class, 'port_exportation', 'id')
            ->withTrashed();
    }

    public function portDest(){
        return $this->belongsTo(Ports::class, 'port_destination', 'id')
            ->withTrashed();
    }

    public function company(){
        return $this->belongsTo(Company::class)
            ->withTrashed();
    }

    public function category(){
        return $this->belongsTo(Category::class)
            ->withTrashed();
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function countryDest(){
        return $this->belongsTo(Country::class, 'country_destination', 'id');
    }

    public function countryExpor(){
        return $this->belongsTo(Country::class, 'country_exportation', 'id');
    }
}
