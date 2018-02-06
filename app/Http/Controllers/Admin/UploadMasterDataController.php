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
        Excel::create('Form Upload Quota', function($sheet) {
            $sheet->freezeFirstRow();
            $head = array(
                'No',
                'Quota',
                'Category',
                'Year'
            );
            $data = array($head);
            $sheet->fromArray($data, null, 'A1', false, false);

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
        $appendix   = AppendixSource::select('appendix_source_code','id')->get()->toArray();
        $source     = Source::select('source_code','id')->get()->toArray();

        Excel::create('Form Upload Spesies', function($excel) use ($categories,$appendix,$source) {

            $excel->sheet('Input Data', function ($sheet) use($categories,$appendix,$source){
                $sheet->freezeFirstRow();
                $sheet->setWidth(array(
                    'A'     => 3,
                    'B'     => 9,
                    'C'     => 9,
                    'D'     => 35,
                    'E'     => 35,
                    'F'     => 35,
                    'F'     => 9,
                    'F'     => 9,
                    'F'     => 8,
                    'j'     =>  50
                ));

                $sheet->setCellValue('A1','No')
                    ->setCellValue('B1','hs_code')
                    ->setCellValue('C1','sp_code')
                    ->setCellValue('D1','species_scientific_name')
                    ->setCellValue('E1','species_general_name')
                    ->setCellValue('F1','species_indonesia_name')
                    ->setCellValue('G1','nominal')
                    ->setCellValue('H1','appendix')
                    ->setCellValue('I1','source')
                    ->setCellValue('J1','species_description')
                    ->setCellValue('K1','category')
                    ->setCellValue('L1','unit')
                    ->setCellValue('M1','id_category')
                    ->setCellValue('X1','0')
                    ->setCellValue('X2','1')
                    ->setCellValue('X3','2')
                    ->setCellValue('Y1','W')
                    ->setCellValue('Y2','R')
                    ->setCellValue('Y3','D')
                    ->setCellValue('Y4','A')
                    ->setCellValue('Y5','C')
                    ->setCellValue('Y6','F')
                    ->setCellValue('Y7','U')
                    ->setCellValue('Y8','I')
                    ->setCellValue('Y9','O');


                $sheet ->fromArray($categories, null, 'V1', false, false)
                        ->fromArray($appendix, null, 'V1', false, false)
                        ->fromArray($source, null, 'V1', false, false);

                for ($i=2; $i <12 ; $i++) {
                    $objValidation = $sheet->getCell('J'.$i)->getDataValidation();
                    $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('categories');

                    $objValidation1 = $sheet->getCell('H'.$i)->getDataValidation();
                    $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                    $objValidation1->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP);
                    $objValidation1->setAllowBlank(false);
                    $objValidation1->setShowInputMessage(true);
                    $objValidation1->setShowErrorMessage(true);
                    $objValidation1->setShowDropDown(true);
                    $objValidation1->setErrorTitle('Input error');
                    $objValidation1->setError('Value is not in list.');
                    $objValidation1->setPromptTitle('Pick from list');
                    $objValidation1->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation1->setFormula1('appendix');

                    $objValidation1 = $sheet->getCell('I'.$i)->getDataValidation();
                    $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                    $objValidation1->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP);
                    $objValidation1->setAllowBlank(false);
                    $objValidation1->setShowInputMessage(true);
                    $objValidation1->setShowErrorMessage(true);
                    $objValidation1->setShowDropDown(true);
                    $objValidation1->setErrorTitle('Input error');
                    $objValidation1->setError('Value is not in list.');
                    $objValidation1->setPromptTitle('Pick from list');
                    $objValidation1->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation1->setFormula1('source');

                    $sheet->setcellValue('L'.$i,'=VLOOKUP(J'.$i.',V1:W64,2,FALSE)');
                }


                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'categories', $sheet, 'V:V'
                    )
                );


                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'appendix', $sheet, 'X:X'
                    )
                );

                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'source', $sheet, 'Y:Y'
                    )
                );

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
                    $data['is_appendix'] = 0;
                    $data['species_category_id'] = 1;
                    $data['nominal'] = $row['nominal'];
                    $data['hs_code'] = $row['hs_code'];
                    $data['sp_code'] = $row['sp_code'];
                    $data['unit_id'] = 1;
                    $data['source_id'] = 1;
                    $data['species_description'] = $row['species_description'];

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

    }
}
