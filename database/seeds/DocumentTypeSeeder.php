<?php

use Illuminate\Database\Seeder;
use App\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::create(['document_type_name' => 'Surat Izin Pengedar']);
        DocumentType::create(['document_type_name' => 'SIUP/IUT']);
        DocumentType::create(['document_type_name' => 'Foto Lingkungan Perusahaan']);
    }
}
