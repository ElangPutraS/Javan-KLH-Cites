<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->input('code');
        $name = $request->input('name');

        $units = Unit::query();

        if($request->filled('code')){
            $units = $units->where('unit_code', 'like', '%'.$code.'%');
        }

        if($request->filled('name')){
            $units = $units->where('unit_description', 'like', '%'.$name.'%');
        }

        $units = $units->orderBy('unit_code','asc')->paginate(10);

        return view('admin.unit.index', compact('units'));
    }
}
