<?php

use Illuminate\Database\Seeder;
use App\Species;
use App\SpeciesQuota;
use Faker\Factory as Faker;


class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(File::get(database_path('json/species.json')), JSON_OBJECT_AS_ARRAY);
        $faker = Faker::create();
        foreach ($jsonData as $key => $item) {

            Species::create([
                'species_scientific_name' => $item['species_scientific_name'],
                'species_indonesia_name' => $item['species_indonesia_name'],
                'species_general_name' => $item['species_general_name'],
                'is_appendix' => $item['is_appendix'],
                'appendix_source_id' => $item['appendix_source_id'],
                'hs_code' => $item['hs_code'],
                'sp_code' => $item['sp_code'],
                'unit_id' => $item['unit_id'],
                'source_id' => $item['source_id'],
                'species_sex_id' => $faker->numberBetween(1,2),
                'nominal' => '100000',
                'species_category_id' => $item['species_category_id']
            ]);
        }

        $jsonData = json_decode(File::get(database_path('json/quotas.json')), JSON_OBJECT_AS_ARRAY);
        foreach ($jsonData as $key => $item) {

            SpeciesQuota::create([
                'quota_amount' => $item['quota_amount'],
                'year' => $item['year'],
                'species_id' => $item['species_id'],
            ]);
        }
    }
}
