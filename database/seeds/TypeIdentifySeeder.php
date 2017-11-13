<?php

use Illuminate\Database\Seeder;
use App\TypeIdentify;

class TypeIdentifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeIdentify::create(['type_identify_name' => 'KTP']);
        TypeIdentify::create(['type_identify_name' => 'SIM']);
    }
}
