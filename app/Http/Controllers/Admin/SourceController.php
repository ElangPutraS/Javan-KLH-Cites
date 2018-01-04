<?php

namespace App\Http\Controllers\Admin;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->input('code');
        $name = $request->input('name');

        $sources = Source::query();

        if($request->filled('code')){
            $sources = $sources->where('source_code', 'like', '%'.$code.'%');
        }

        if($request->filled('name')){
            $sources = $sources->where('source_description', 'like', '%'.$name.'%');
        }

        $sources = $sources->orderBy('source_code','asc')->paginate(10);

        return view('admin.source.index', compact('sources'));
    }
}
