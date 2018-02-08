<?php

namespace App\Http\Controllers\Admin;

use App\AppendixSource;
use App\Category;
use App\Source;
use App\Species;
use Excel;
use App\SpeciesQuota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UploadMasterDataController extends Controller
{
    public function index(Request $request)
    {
        return view('superadmin.upload');
    }

    public function quotaExcel()
    {
        $categories = Category::select('species_category_name', 'id')->get()->toArray();
        Excel::create('Form Upload Quota', function($excel) use($categories) {
            $excel->sheet('Input Data', function ($sheet) use ($categories) {
                $sheet->freezeFirstRow();

                $sheet->setCellValue('A1','No')
                    ->setCellValue('B1','quota_amount')
                    ->setCellValue('C1','year')
                    ->setCellValue('D1','species_id');

//                $sheet->_parent->addNamedRange(
//                    new \PHPExcel_NamedRange(
//                        'categories', $sheet, 'V:V'
//                    )
//                );
//
//                $objValidation = $sheet->getCell('D2')->getDataValidation();
//                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
//                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP);
//                $objValidation->setAllowBlank(false);
//                $objValidation->setShowInputMessage(true);
//                $objValidation->setShowErrorMessage(true);
//                $objValidation->setShowDropDown(true);
//                $objValidation->setErrorTitle('Input error');
//                $objValidation->setError('Value is not in list.');
//                $objValidation->setPromptTitle('Pick from list');
//                $objValidation->setPrompt('Please pick a value from the drop-down list.');
//                $objValidation->setFormula1('categories');
//
//                $sheet->setcellValue('E2','=VLOOKUP(D2,V1:W64,2,FALSE)');
//
//                $sheet ->fromArray($categories, null, 'V1', false, false);
            });
        })->download('xlsx');
    }

    public function categoryExcel()
    {
        Excel::create('Form Upload Kategori', function($excel) {
            $excel->sheet('Input Data', function ($sheet) {
                $sheet->freezeFirstRow();
                $head = array(
                    'No',
                    'species_category_code',
                    'species_category_name'
                );
            $data = array($head);
            $sheet->fromArray($data, null, 'A1', false, false);
        });
        })->download('xlsx');
    }

    public function speciesExcel()
    {
        $categories = Category::select('species_category_name', 'id')->get()->toArray();
//        $appendix   = AppendixSource::select('appendix_source_code','id')->get()->toArray();
//        $source     = Source::select('source_code','id')->get()->toArray();

        Excel::create('Form Upload Spesies', function($excel) use ($categories) {

            $excel->sheet('Input Data', function ($sheet) use($categories){
                $sheet->setWidth(array(
                    'A'     => 3,
                    'B'     => 9,
                    'C'     => 9,
                    'D'     => 35,
                    'E'     => 35,
                    'F'     => 30,
                    'F'     => 9,
                    'F'     => 9,
                    'F'     => 8,
                    'j'     => 20,
                    'K'     => 35
                ));

                $sheet->setCellValue('A1','No')
                    ->setCellValue('B1','hs_code')
                    ->setCellValue('C1','sp_code')
                    ->setCellValue('D1','species_scientific_name')
                    ->setCellValue('E1','species_general_name')
                    ->setCellValue('F1','species_indonesia_name')
                    ->setCellValue('G1','nominal')
                    ->setCellValue('H1','species_description')
                    ->setCellValue('I1','species_category_id')
                    ->setCellValue('J1','source_id')
                    ->setCellValue('K1','unit_id')
                    ->setCellValue('L1','is_appendix')
                    ->setCellValue('M1','appendix_source_id');
            });

        })->download('xlsx');
    }


    public function importSpecies(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['species_scientific_name'] = $row['species_scientific_name'];
                    $data['species_indonesia_name'] = $row['species_indonesia_name'];
                    $data['species_general_name'] = $row['species_general_name'];
                    $data['species_category_id'] = $row['species_category_id'];
                    $data['nominal'] = $row['nominal'];
                    $data['hs_code'] = $row['hs_code'];
                    $data['sp_code'] = $row['sp_code'];
                    $data['unit_id'] = $row['unit_id'];
                    $data['source_id'] = $row['source_id'];
                    $data['species_description'] = $row['species_description'];
                    $data['is_appendix'] = $row['is_appendix'];
                    $data['appendix_source_id'] = $row['appendix_source_id'];

                    if(!empty($data)) {
                        \DB::table('Species')->insert($data);
                    }
                }
            });
            return back()->with('success','Data berhasil ditambahkan');
        }

        return back()->with('warning','Data spesies tidak ditemukan, Silahkan tambahkan data');
    }

    public function importCategory(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['species_category_code'] = $row['species_category_code'];
                    $data['species_category_name'] = $row['species_category_name'];

                    if(!empty($data)) {
                        \DB::table('categories')->insert($data);
                    }
                }
            });
            return back()->with('success','Data berhasil ditambahkan');
        }

        return back()->with('warning','Data kategori tidak ditemukan, Silahkan tambahkan data');
    }

    public function importQuota(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['quota_amount'] = $row['quota_amount'];
                    $data['year'] = $row['year'];
                    $data['species_id'] = $row['species_id'];

                    if(!empty($data)) {
                        \DB::table('species_quota')->insert($data);
                    }
                }
            });
            return back()->with('success','Data berhasil ditambahkan');
        }

        return back()->with('warning','Data kategori tidak ditemukan, Silahkan tambahkan data');
    }


    public function downloadCategory()
    {
        $categories = Category::select('species_category_name', 'id')->get()->toArray();
        Excel::create('Data Kategori Spesies', function($excel) use ($categories) {
            $excel->sheet('Data', function ($sheet) use ($categories) {
                $sheet->cells('B:B', function($cells) {

                    $cells->setBackground('#FFFF00');

                });
                $sheet->freezeFirstRow();
                $sheet->row(1, function($row) { $row->setBackground('#CCCCCC'); });
                $sheet->fromArray($categories);
            });
        })->download('xlsx');
    }

    public function downloadSpecies()
    {
        $species = Species::select('species_scientific_name', 'species_general_name', 'species_indonesia_name', 'id')->get()->toArray();
        Excel::create('Data Spesies', function($excel) use ($species) {
            $excel->sheet('Data', function ($sheet) use ($species) {
                $sheet->setWidth(array(
                    'A'     => 40,
                    'B'     => 40,
                    'C'     => 23,
                    'D'     => 7,
                ));
                $sheet->cells('D:D', function($cells) {

                    $cells->setBackground('#FFFF00');

                });
                $sheet->freezeFirstRow();
                $sheet->row(1, function($row) { $row->setBackground('#CCCCCC'); });
                $sheet->fromArray($species);
            });
        })->download('xlsx');
    }
}
