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

        if($request->input('code') == '' && $request->input('name') == '' || $request->input('code') == null && $request->input('name') == null ){
            $units = Unit::orderBy('unit_code', 'asc')->paginate(10);
        }else{
            $code = '%'.$request->input('code').'%';
            $name = '%'.$request->input('name').'%';

            $units = Unit::where('unit_code', 'like', $code)
                ->where('unit_description', 'like', $name)
                ->orderBy('unit_code')->paginate(10);
        }


        return view('admin.unit.index', compact('units'));
    }
}
