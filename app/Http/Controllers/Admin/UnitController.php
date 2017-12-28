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
            $code = '%'.$request->input('c').'%';
            $name = '%'.$request->input('n').'%';

            $units = Unit::where('unit_code', 'like', $code)
                ->where('unit_description', 'like', $name)
                ->orderBy('unit_code')->paginate(10);
        }


        return view('admin.unit.index', compact('units'));
    }
}
