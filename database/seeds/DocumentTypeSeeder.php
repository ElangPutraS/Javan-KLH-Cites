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
        DocumentType::create([
            'document_type_name' => 'Surat Izin Pengedar',
            'is_permit' => 0,
        ]);

        DocumentType::create([
            'document_type_name' => 'SIUP/IUT',
            'is_permit' => 0,
        ]);

        DocumentType::create([
            'document_type_name' => 'Foto Lingkungan Perusahaan',
            'is_permit' => 0,
        ]);

        DocumentType::create([
            'document_type_name' => 'Balai Konservasi SDA',
            'is_permit' => 1,
        ]);

        DocumentType::create([
            'document_type_name' => 'BAP Stok Ekspor',
            'is_permit' => 1,
        ]);

        DocumentType::create([
            'document_type_name' => 'Form C',
            'is_permit' => 1,
        ]);

        DocumentType::create([
            'document_type_name' => 'Dokumen Asal Usul',
            'is_permit' => 1,
        ]);

        DocumentType::create([
            'document_type_name' => 'Dokumen Izin Impor',
            'is_permit' => 3,
        ]);
    }
}
