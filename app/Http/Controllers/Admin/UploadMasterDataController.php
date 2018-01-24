<?php

namespace App\Http\Controllers\Admin;

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
        return Excel::create('Data Quota', function($excel) use ($quota) {
            $excel->sheet('sheet name', function($sheet) use ($quota)
            {
                $sheet->fromArray($quota);
            });
        })->download($type);
    }

    public function speciesExcel()
    {
        Excel::create('Form Species', function($excel) {
            $excel->sheet('Sheet Name', function($sheet) {

                $head = array(
                    'Title 1',
                    'Title 2',
                    'Title 3',
                    'Title 4'
                );

                $data = array($head);
                $sheet->fromArray($data, null, 'A4', false, false);
            });
        })->download('xlsx');
    }
}
