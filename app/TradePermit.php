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
        return $this->belongsTo(PurposeType::class);
    }

    public function tradeStatus(){
        return $this->belongsTo(TradePermitStatus::class, 'trade_permit_status_id');
    }

    public function tradeSpecies()
    {
        return $this->belongsToMany(Species::class, 'trade_permit_detail')
            ->withPivot('total_exported');
    }

    public function portExpor(){
        return $this->belongsTo(Ports::class, 'port_exportation', 'id');
    }

    public function portDest(){
        return $this->belongsTo(Ports::class, 'port_destination', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function pnbp(){
        return $this->hasOne(Pnbp::class);
    }

    public function logTrade() {
        return $this->hasMany(LogTradePermit::class, 'trade_permit_id', 'id');
    }

}
