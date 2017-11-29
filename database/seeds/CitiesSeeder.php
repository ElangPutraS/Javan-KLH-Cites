<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitiesSeeder extends Seeder
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
        	DB::statement('TRUNCATE TABLE cities');

            $jsonData = json_decode(File::get(database_path('json/cities.json')), JSON_OBJECT_AS_ARRAY);
        	$faker = Faker::create();

        	foreach ($jsonData as $key => $item) {
        		//DB::table('ports')->insert($item);
        		DB::table('cities')->insert([
        			'city_code' => $item['city_code'],
        			'city_name' => $item['city_name'],
                    'city_name_full' => $item['city_name_full'],
                    'province_id' => $item['province_id'],
        			'created_at' => $faker->dateTime(),
        			'updated_at' => date('Y-m-d h:i:s')
        		]);
        	}
        });
    }
}
