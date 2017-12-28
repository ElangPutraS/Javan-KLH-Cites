<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TradePermit extends Model
{
    protected $table = "trade_permit";

    protected $fillable = [
        'trade_permit_code',
        'consignee',
        'appendix_type',
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
        'updated_by',
        'valid_renewal',
        'permit_type',
        'reject_reason',
        'consignee_address',
        'category_id',
        'source_id',
        'country_destination',
        'country_exportation',
        'is_blanko',
        'is_renewal',
        'is_printed',
        'stamp',
    ];

    public function documentTypes()
    {
        return $this->belongsToMany(DocumentType::class, 'trade_permit_document')
            ->withPivot('document_name', 'file_path')
            ->using(TradePermitDocument::class);
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

    public function tradeSpecies()
    {
        return $this->belongsToMany(Species::class, 'trade_permit_detail')
            ->withPivot('total_exported', 'log_trade_permit_id', 'description', 'valid_renewal', 'id', 'company_id', 'year', 'trade_permit_id')
            ->withTrashed();
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

    public function pnbp(){
        return $this->hasOne(Pnbp::class);
    }

    public function logTrade() {
        return $this->hasMany(LogTradePermit::class, 'trade_permit_id', 'id');
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
