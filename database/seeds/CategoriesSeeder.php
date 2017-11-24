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
        Category::create([
            'species_category_code' => 'k1',
            'species_category_name' => 'Mamalia',
        ]);

        Category::create([
            'species_category_code' => 'k2',
            'species_category_name' => 'Reptilia',
        ]);

        Category::create([
            'species_category_code' => 'k3',
            'species_category_name' => 'Ular/Snakes',
        ]);

        Category::create([
            'species_category_code' => 'k4',
            'species_category_name' => 'Biawak/Monitors',
        ]);

        Category::create([
            'species_category_code' => 'k5',
            'species_category_name' => 'Kura - kura/Turtles',
        ]);

        Category::create([
            'species_category_code' => 'k6',
            'species_category_name' => 'Buaya/Crocodiles',
        ]);

        Category::create([
            'species_category_code' => 'k7',
            'species_category_name' => 'Burung/Aves',
        ]);

        Category::create([
            'species_category_code' => 'k8',
            'species_category_name' => 'Cicak/Gecko',
        ]);
        Category::create([
            'species_category_code' => 'k9',
            'species_category_name' => 'Amphibia',
        ]);

        Category::create([
            'species_category_code' => 'k10',
            'species_category_name' => 'Arthropoda:Arachnida',
        ]);
    }
}
