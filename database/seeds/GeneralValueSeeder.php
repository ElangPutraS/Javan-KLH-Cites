<?php

use Illuminate\Database\Seeder;

class GeneralValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['name' => 'Harga Blangko', 'value' => 100000, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')],
            ['name' => 'Harga Penambah Uang', 'value' => 200000, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]
        ];

        DB::table('general_value')->insert($data);
    }
}
