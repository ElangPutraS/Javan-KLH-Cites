<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $code1 = ''; $code2= ''; $code3 = '';
        $name1 = ''; $name2 = ''; $name3 = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $units = Unit::orderBy('unit_code', 'asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code1 = '%'.$request->input('c');
                $code2 = '%'.$request->input('c').'%';
                $code3 = $request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name1 = '%'.$request->input('n');
                $name2 = '%'.$request->input('n').'%';
                $name3 = $request->input('n').'%';
            }

            $units = Unit::where('unit_code', 'like', $code1)
                ->orWhere('unit_code', 'like', $code2)
                ->orWhere('unit_code', 'like', $code3)
                ->orWhere('unit_description', 'like', $name1)
                ->orWhere('unit_description', 'like', $name2)
                ->orWhere('unit_description', 'like', $name3)
                ->orderBy('unit_code')->paginate(10);
        }


        return view('admin.unit.index', compact('units'));
    }
}
