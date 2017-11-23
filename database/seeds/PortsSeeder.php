<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::transaction(function () {
        	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        	DB::statement('TRUNCATE TABLE ports');

            $jsonData = json_decode(File::get(database_path('json/ports.json')), JSON_OBJECT_AS_ARRAY);
        	$faker = Faker::create();

        	foreach ($jsonData as $key => $item) {
        		//DB::table('ports')->insert($item);
        		DB::table('ports')->insert([
        			'port_code' => $item['port_code'],
        			'port_name' => $item['port_name'],
        			'created_at' => $faker->dateTime(),
        			'updated_at' => date('Y-m-d h:i:s')
        		]);
        	}
        });
    }
}
