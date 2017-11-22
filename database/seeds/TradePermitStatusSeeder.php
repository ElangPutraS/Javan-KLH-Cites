<?php

use Illuminate\Database\Seeder;
use App\TradePermitStatus;

class TradePermitStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TradePermitStatus::create([
            'status_code' => '100',
            'status_name' => 'Penerimaan Permohonan'
        ]);

        TradePermitStatus::create([
            'status_code' => '200',
            'status_name' => 'Verifikasi Permohonan'
        ]);

        TradePermitStatus::create([
            'status_code' => '300',
            'status_name' => 'Penahanan/Penolakan Permohonan'
        ]);

        TradePermitStatus::create([
            'status_code' => '400',
            'status_name' => 'Perintah Pemeriksaan Barang'
        ]);

        TradePermitStatus::create([
            'status_code' => '401',
            'status_name' => 'Barang Belum Siap diperiksa'
        ]);

        TradePermitStatus::create([
            'status_code' => '402',
            'status_name' => 'Barang Siap diperiksa'
        ]);

        TradePermitStatus::create([
            'status_code' => '500',
            'status_name' => 'Pemeriksaan Barang'
        ]);

        TradePermitStatus::create([
            'status_code' => '600',
            'status_name' => 'Penerbitan Perijinan/Rekomendasi'
        ]);

        TradePermitStatus::create([
            'status_code' => '700',
            'status_name' => 'Pengiriman Perijinan/Rekomendasi'
        ]);

        TradePermitStatus::create([
            'status_code' => '800',
            'status_name' => 'Penerimaan di INSW'
        ]);
    }
}
