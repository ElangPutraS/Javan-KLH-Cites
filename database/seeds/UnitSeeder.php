<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'unit_code' => 'A',
            'unit_description' => 'Pc(s)',
        ]);

        Unit::create([
            'unit_code' => 'B',
            'unit_description' => 'Bottle(s)',
        ]);

        Unit::create([
            'unit_code' => 'C',
            'unit_description' => 'cc',
        ]);

        Unit::create([
            'unit_code' => 'D',
            'unit_description' => 'mL',
        ]);

        Unit::create([
            'unit_code' => 'G',
            'unit_description' => 'Gram(s)',
        ]);

        Unit::create([
            'unit_code' => 'H',
            'unit_description' => 'Head(s)',
        ]);

        Unit::create([
            'unit_code' => 'K',
            'unit_description' => 'Kg(s)',
        ]);

        Unit::create([
            'unit_code' => 'L',
            'unit_description' => 'Slide(s)',
        ]);

        Unit::create([
            'unit_code' => 'M',
            'unit_description' => 'CBM',
        ]);

        Unit::create([
            'unit_code' => 'P',
            'unit_description' => 'Pc(s)',
        ]);

        Unit::create([
            'unit_code' => 'S',
            'unit_description' => 'Sheet(s)',
        ]);

        Unit::create([
            'unit_code' => 'T',
            'unit_description' => 'Tube(s)',
        ]);

        Unit::create([
            'unit_code' => 'V',
            'unit_description' => 'Vial(s)',
        ]);
    }
}
