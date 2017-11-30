<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(File::get(database_path('json/categories.json')), JSON_OBJECT_AS_ARRAY);
        foreach ($jsonData as $key => $item) {

            Category::create([
                'species_category_code' => $item['species_category_code'],
                'species_category_name' => $item['species_category_name']
            ]);
        }
    }
}
