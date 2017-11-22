<?php

use Illuminate\Database\Seeder;
use App\Ports;

class PortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ports::create([
            'port_code' => 'IDAAS',
            'port_name' => 'Apalapsili',
        ]);

        Ports::create([
            'port_code' => 'IDABU',
            'port_name' => 'Atambua',
        ]);

        Ports::create([
            'port_code' => 'IDADB',
            'port_name' => 'Adang Bay',
        ]);

        Ports::create([
            'port_code' => 'IDAEG',
            'port_name' => 'Aekgodang',
        ]);

        Ports::create([
            'port_code' => 'IDAGD',
            'port_name' => 'Anggi',
        ]);
    }
}
