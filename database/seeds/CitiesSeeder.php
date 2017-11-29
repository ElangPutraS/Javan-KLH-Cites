<?php

use Illuminate\Database\Seeder;

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
    

            $jsonData = json_decode(File::get(database_path('json/cities.json')), JSON_OBJECT_AS_ARRAY);
        	foreach ($jsonData as $key => $item) {
        		//DB::table('ports')->insert($item);
        		Country::create([
                    'city_code' => $item['city_code'],
                    'city_name' => $item['city_name'],
                    'city_name_full' => $item['city_name_full'],
                    'province_id' => $item['province_id']
                ])
        		]);
        	}
        });
    }
}
