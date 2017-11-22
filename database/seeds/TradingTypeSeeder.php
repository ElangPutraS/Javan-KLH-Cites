<?php

use Illuminate\Database\Seeder;
use App\TradingType;

class TradingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TradingType::create(['trading_type_code' => 'IM', 'trading_type_name' => 'Importir']);
        TradingType::create(['trading_type_code' => 'EX', 'trading_type_name' => 'Eksportir']);
        TradingType::create(['trading_type_code' => 'SU', 'trading_type_name' => 'Supplier']);
        TradingType::create(['trading_type_code' => 'RX', 'trading_type_name' => 'Re-Ekspor']);
    }
}
