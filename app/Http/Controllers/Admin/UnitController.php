<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('unit_code', 'asc')->paginate(10);

        return view('admin.unit.index', compact('units'));
    }
}
