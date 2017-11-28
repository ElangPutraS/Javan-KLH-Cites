<?php

use Illuminate\Database\Seeder;
use App\AppendixSource;
use App\SpeciesSex;

class MasterSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppendixSource::create([
            'appendix_source_code' => 'Appendix I',
            'description' => 'Description Appendix I',
        ]);

        AppendixSource::create([
            'appendix_source_code' => 'Appendix II',
            'description' => 'Description Appendix II',
        ]);

        SpeciesSex::create([
            'sex_code' => 'BTN001',
            'sex_name' => 'Betina',
        ]);

        SpeciesSex::create([
            'sex_code' => 'JNT001',
            'sex_name' => 'Jantan',
        ]);
    }
}
