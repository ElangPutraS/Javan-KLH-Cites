<?php

use Illuminate\Database\Seeder;
use App\Species;
use App\Category;
use App\AppendixSource;
use App\SpeciesSex;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //species 1
        $category=Category::find(1);
        $appendix=AppendixSource::find(1);
        $speciesSex=SpeciesSex::find(1);
        $species=Species::create([
            'species_scientific_name'=>'Pteropus vampyrus',
            'species_indonesia_name'=>'Common Flying-fox',
            'species_general_name'=>'Kalong Kapak',
            'is_appendix'=>'1'
        ]);
        $species->speciesCategory()->associate($category);
        $species->appendixSource()->associate($appendix);
        $species->speciesSex()->associate($speciesSex);
        //

        //species 2
        $category=Category::find(3);
        $appendix=AppendixSource::find(1);
        $speciesSex=SpeciesSex::find(1);
        $species=Species::create([
            'species_scientific_name'=>'Liasis (Apodora) papuanus ',
            'species_indonesia_name'=>'Papuan Olive Python',
            'species_general_name'=>'Ular Sanca Irian',
            'is_appendix'=>'1'
        ]);
        $species->speciesCategory()->associate($category);
        $species->appendixSource()->associate($appendix);
        $species->speciesSex()->associate($speciesSex);
        //

        //species 3
        $category=Category::find(4);
        $appendix=AppendixSource::find(2);
        $speciesSex=SpeciesSex::find(2);
        $species=Species::create([
            'species_scientific_name'=>'Varanus doreanus',
            'species_indonesia_name'=>'Blue Tail Monitor',
            'species_general_name'=>'Biawak Ekor Biru',
            'is_appendix'=>'1'
        ]);
        $species->speciesCategory()->associate($category);
        $species->appendixSource()->associate($appendix);
        $species->speciesSex()->associate($speciesSex);
        //

        //species 4
        $category=Category::find(5);
        $appendix=AppendixSource::find(1);
        $speciesSex=SpeciesSex::find(2);
        $species=Species::create([
            'species_scientific_name'=>'Amyda cartilaginea ',
            'species_indonesia_name'=>'Asiatic Softshell turtle',
            'species_general_name'=>'Labi-Labi / Bulus',
            'is_appendix'=>'1'
        ]);
        $species->speciesCategory()->associate($category);
        $species->appendixSource()->associate($appendix);
        $species->speciesSex()->associate($speciesSex);
        //

        //species 4
        $category=Category::find(6);
        $appendix=AppendixSource::find(1);
        $speciesSex=SpeciesSex::find(2);
        $species=Species::create([
            'species_scientific_name'=>'Crocodylus novaeguineae ',
            'species_indonesia_name'=>'New Guinea Fresh Water ',
            'species_general_name'=>'Crocodile /Buaya Irian',
            'is_appendix'=>'1'
        ]);
        $species->speciesCategory()->associate($category);
        $species->appendixSource()->associate($appendix);
        $species->speciesSex()->associate($speciesSex);
        //
    }


}
