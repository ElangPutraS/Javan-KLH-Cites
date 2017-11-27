<?php

use Illuminate\Database\Seeder;
use App\Species;
use App\Category;
use App\AppendixSource;
use App\SpeciesSex;
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
                'is_appendix' => '1',
                'appendix_source_id' => '2',
                'species_sex_id' => $faker->numberBetween(1,2),
                'species_category_id' => $item['species_category_id']
            ]);
        }
    }
}
