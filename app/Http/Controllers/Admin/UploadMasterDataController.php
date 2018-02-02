<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Species;
use Excel;
use App\SpeciesQuota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadMasterDataController extends Controller
{
    public function index(Request $request)
    {
        return view('superadmin.upload');
    }

    public function quotaExcel($type)
    {
        $quota = SpeciesQuota::get()->toArray();
        Excel::create('Data Quota', function($excel) use ($quota) {
            $excel->sheet('sheet name', function($sheet) use ($quota)
            {
                $sheet->fromArray($quota);
            });
        })->download($type);
    }

    public function speciesExcel()
    {
        $categories = Category::get()->toArray();
        Excel::create('Form Upload Spesies', function($excel) use ($categories) {

            $excel->sheet('Input Data', function ($sheet){
                $head = array(
                    'No',
                    'hs_code',
                    'sp_code',
                    'species_scientific_name',
                    'species_general_name',
                    'species_indonesia_name',
                    'nominal',
                    'appendix',
                    'source',
                    'category'
                );
                $objValidation = $sheet->getCell('J2')->getDataValidation();
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

                //note this!
                $data = array($head);
                $sheet->fromArray($data, null, 'A1', false, false);
            });

            $excel->sheet('Data Kategori Spesies', function($sheet) use ($categories)
            {
                $sheet->fromArray($categories);
                $sheet->setFreeze('A1');
                $sheet->_parent->addNamedRange(
                    new \PHPExcel_NamedRange(
                        'categories', $sheet, 'C:C'
                    )
                );
            });
//            $excel->setAct$excel->setActiveSheetIndex(0);
//            iveSheetIndex(1);

        })->download('xlsx');
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
//                dd($reader);
                foreach ($reader->toArray() as $key => $row) {
                    dd($key);
                    $data['species_scientific_name'] = $row['species_scientific_name'];
                    $data['species_indonesia_name'] = $row['species_indonesia_name'];
                    $data['species_general_name'] = $row['species_general_name'];
                    $data['is_appendix'] = 0;
                    $data['appendix_source_id'] = 0;
                    $data['species_category_id'] = 1;
                    $data['nominal'] = $row['nominal'];
                    $data['hs_code'] = $row['hs_code'];
                    $data['sp_code'] = $row['sp_code'];
                    $data['unit_id'] = 1;
                    $data['source_id'] = 1;
                    $data['species_description'] = $row['species_description'];

                    if(!empty($data)) {
                        DB::table('Species')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }
}
