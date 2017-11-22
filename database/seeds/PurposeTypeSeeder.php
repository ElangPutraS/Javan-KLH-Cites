<?php

use Illuminate\Database\Seeder;
use App\PurposeType;

class PurposeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurposeType::create([
            'purpose_type_code' => 'T',
            'purpose_type_name' => 'Komersial'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'Z',
            'purpose_type_name' => 'Kebun Binatang'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'G',
            'purpose_type_name' => 'Kebun Raya'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'Q',
            'purpose_type_name' => 'Sirkus dan Peragaan Keliling'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'S',
            'purpose_type_name' => 'Scientific'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'H',
            'purpose_type_name' => 'Hasil Berburu'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'P',
            'purpose_type_name' => 'Perorangan'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'M',
            'purpose_type_name' => 'Medikal (termasuk penelitian biomedikal)'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'E',
            'purpose_type_name' => 'Pendidikan'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'N',
            'purpose_type_name' => 'Reintroduksi atau introduksi ke habitat alam'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'B',
            'purpose_type_name' => 'Hasil penangkaran atau hasil budidaya'
        ]);

        PurposeType::create([
            'purpose_type_code' => 'L',
            'purpose_type_name' => 'Penegak Hukum / pengadilan / forensik'
        ]);
    }
}
