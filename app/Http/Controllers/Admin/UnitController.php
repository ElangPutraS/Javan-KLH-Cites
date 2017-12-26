<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $code = '';
        $name = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $units = Unit::orderBy('unit_code', 'asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code = '%'.$request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name = '%'.$request->input('n').'%';
            }

            $units = Unit::where('unit_code', 'like', $code)
                ->orWhere('unit_description', 'like', $name)
                ->orderBy('unit_code')->paginate(10);
        }


        return view('admin.unit.index', compact('units'));
    }
}
