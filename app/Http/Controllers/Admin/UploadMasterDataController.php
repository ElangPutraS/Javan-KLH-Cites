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

        Excel::create('FormUploadKuota', function($excel) {
            $species = Species::select('species_scientific_name', 'id')->orderBy('species_scientific_name')->get()->toArray();
            $excel->sheet('Input Data', function ($sheet) use ($species) {
                $sheet->freezeFirstRow()
                    ->setWidth(array(
                        'D' => 45
                        ))
                    ->setCellValue('A1','No')
                    ->setCellValue('B1','quota_amount')
                    ->setCellValue('C1','year')
                    ->setCellValue('D1','species')
                    ->setCellValue('E1','species_id');

                $objValidation = $sheet->getCell('D2')->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST)
                    ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP)
                    ->setAllowBlank(false)
                    ->setShowInputMessage(true)
                    ->setShowErrorMessage(true)
                    ->setShowDropDown(true)
                    ->setErrorTitle('Input error')
                    ->setError('Value is not in list.')
                    ->setPromptTitle('Pick from list')
                    ->setPrompt('Please pick a value from the drop-down list.')
                    ->setFormula1('species');

                $sheet->setcellValue('E2','=VLOOKUP(D2,Referensi!A1:W'.count($species). ' ,2,FALSE)');

            });

            $excel->sheet('Referensi', function ($sheet) use ($species) {
                $sheet ->fromArray($species, null, 'A1', false, false);

                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'species', $sheet, 'A:A'
                    )
                );
            });
        })->download('xlsx');
    }

    public function categoryExcel()
    {
        Excel::create('FormUploadKategori', function($excel) {
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
        Excel::create('FormUploadSpesies', function($excel) use ($categories) {

            $excel->sheet('Input Data', function ($sheet) use($categories){
                $sheet->setWidth(array(
                    'A'     => 3,
                    'B'     => 9,
                    'C'     => 9,
                    'D'     => 35,
                    'E'     => 35,
                    'F'     => 35,
                    'G'     => 10,
                    'H'     => 15,
                    'I'     => 35,
                    'j'     => 7,
                    'K'     => 7,
                    'L'     => 10
                ));

                $sheet->setCellValue('A1','No')
                    ->setCellValue('B1','hs_code')
                    ->setCellValue('C1','sp_code')
                    ->setCellValue('D1','species_scientific_name')
                    ->setCellValue('E1','species_general_name')
                    ->setCellValue('F1','species_indonesia_name')
                    ->setCellValue('G1','nominal')
                    ->setCellValue('H1','species_description')
                    ->setCellValue('I1','category')
                    ->setCellValue('J1','source')
                    ->setCellValue('K1','unit')
                    ->setCellValue('L1','appendix')
                    ->setCellValue('M1','species_category_id')
                    ->setCellValue('N1','source_id')
                    ->setCellValue('O1','unit_id')
                    ->setCellValue('P1','is_appendix')
                    ->setCellValue('Q1','appendix_source_id');

                    $i =2;
                    $sheet->setcellValue('M'.$i,'=IF(I'.$i. '<>"",VLOOKUP(I'.$i. ',Referensi!A1:B'.count($categories). ',2,FALSE),"")')
                        ->setCellValue('N'.$i, '=IF(J'.$i. '<>"",VLOOKUP(J'.$i. ',Referensi!D1:E9,2,FALSE),"")')
                        ->setCellValue('O'.$i,'=IF(K'.$i. '<>"",VLOOKUP(K'.$i. ',Referensi!F1:G13,2,FALSE),"")')
                        ->setCellValue('P'.$i,'=IF(L'.$i. '<>"",IF(L'.$i. '<>0,1,0),"")')
                        ->setCellValue('Q'.$i,'=IF(L'.$i. '=0,"",IF(L'.$i. '=1,1,2))');

                    $objValidation = $sheet->getCell('I'.$i)->getDataValidation();
                    $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('Input error')
                        ->setError('Value is not in list.')
                        ->setPromptTitle('Pick from list')
                        ->setPrompt('Please pick a value from the drop-down list.')
                        ->setFormula1('categories');

                    $objValidation1 = $sheet->getCell('L'.$i)->getDataValidation();
                    $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('Input error')
                        ->setError('Value is not in list.')
                        ->setPromptTitle('Pick from list')
                        ->setPrompt('Please pick a value from the drop-down list.')
                        ->setFormula1('appendix');

                    $objValidation2 = $sheet->getCell('J'.$i)->getDataValidation();
                    $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('Input error')
                        ->setError('Value is not in list.')
                        ->setPromptTitle('Pick from list')
                        ->setPrompt('Please pick a value from the drop-down list.')
                        ->setFormula1('source');

                    $objValidation3 = $sheet->getCell('K'.$i)->getDataValidation();
                    $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_STOP)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('Input error')
                        ->setError('Value is not in list.')
                        ->setPromptTitle('Pick from list')
                        ->setPrompt('Please pick a value from the drop-down list.')
                        ->setFormula1('unit');
            });

            $excel->sheet('Referensi', function ($sheet) use($categories){
                $sheet ->fromArray($categories, null, 'A1', false, false);
                $sheet->setCellValue('C1','0')
                    ->setCellValue('C2','1')
                    ->setCellValue('C3','2');

                $source = ['W','R','D','A','C','F','U','I','O'];
                $unit   = ['Pc(s)','Bottle(s)','cc','mL','Gram(s)','Head(s)','Kg(s)','Slide(s)','CBM','Pc(s)','Sheet(s)','Tube(s)','Vial(s)'];

                for ($i=0; $i <count($source) ; $i++) {
                    $sheet->setCellValue('D'.($i+1), $source[$i]);
                }

                for ($i=1; $i <10 ; $i++){
                    $sheet->setCellValue('E'.$i,$i);
                }

                for ($i=0; $i <count($unit) ; $i++) {
                    $sheet->setCellValue('F'.($i+1), $unit[$i]);
                }

                for ($i=1; $i <count($unit)+1 ; $i++){
                    $sheet->setCellValue('G'.$i,$i);
                }
                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'categories', $sheet, 'A:A'
                    )
                );


                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'appendix', $sheet, 'C1:C3'
                    )
                );

                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'source', $sheet, 'D1:D9'
                    )
                );

                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'unit', $sheet, 'F1:F9'
                    )
                );

            });



        })->download('xlsx');
    }


    public function importSpecies(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                $activeSheet = $reader->first();
                if ($reader->getTitle() == 'Form Upload Spesies'){
                foreach ($activeSheet->toArray() as $key => $row) {
                    //dd($reader->getTitle());
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
                    }

                    if(!empty($data['species_scientific_name'])) {
                        Species::create($data);
                        return redirect()->route('superadmin.upload')->with('success','Data berhasil ditambahkan');
                    }
                    return redirect()->route('superadmin.upload')->with('warning','Data tidak ada');
                }
                return redirect()->route('superadmin.upload')->with('warning','Format data salah');
            });
        }
    }

    public function importCategory(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    if ($reader->getTitle() == "Form Upload Kategori") {
                        $data['species_category_code'] = $row['species_category_code'];
                        $data['species_category_name'] = $row['species_category_name'];

                        if (!empty($data['species_category_code'])) {
                            Category::create($data);
                        }
                    }
                }
            });
            //return back()->with('warning','Format upload salah');
        }

        return back()->with('warning','Format data salah atau tidak , Silahkan tambahkan data');
    }

    public function importQuota(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                $activeSheet = $reader->first();
                foreach ($activeSheet->toArray() as $key => $row) {
                    $data['quota_amount'] = $row['quota_amount'];
                    $data['year'] = $row['year'];
                    $data['species_id'] = $row['species_id'];

                    if(!empty($data)) {
                        SpeciesQuota::create($data);
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
