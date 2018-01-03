<?php

namespace App\Http\Controllers\Admin;

use App\AppendixSource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppendixSourceController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->input('code');
        $name = $request->input('name');

        $appendix_sources = AppendixSource::query();

        if($request->filled('code')){
            $appendix_sources = $appendix_sources->where('appendix_source_code', 'like', '%'.$code.'%');
        }

        if($request->filled('name')){
            $appendix_sources = $appendix_sources->where('description', 'like', '%'.$name.'%');
        }

        $appendix_sources = $appendix_sources->orderBy('appendix_source_code','asc')->paginate(10);

        return view('admin.appendixSource.index', compact('appendix_sources'));
    }
}
