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

            $excel->sheet('Input Data', function ($sheet){
                $head = array(
                    'No',
                    'Scientific Name',
                    'General Name',
                    'Indonesia Name',
                    'Nominal',
                    'Appendix',
                    'Source',
                    'Category'
                );
                $objValidation = $sheet->getCell('H2')->getDataValidation();
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
            $excel->setActiveSheetIndex(1);

        })->download('xlsx');
    }
}
