<?php

namespace App\Http\Controllers\Admin;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    public function index(Request $request)
    {
        $code = '';
        $name = '';

        if($request->input('code') == '' && $request->input('name') == '' || $request->input('code') == null && $request->input('name') == null ){
            $sources = Source::orderBy('source_code', 'asc')->paginate(10);
        }else{
            $code = '%'.$request->input('code').'%';
            $name = '%'.$request->input('name').'%';

            $sources = Source::where('source_code', 'like', $code)
                ->where('source_description', 'like', $name)
                ->orderBy('source_code')->paginate(10);
        }

        return view('admin.source.index', compact('sources'));
    }
}
