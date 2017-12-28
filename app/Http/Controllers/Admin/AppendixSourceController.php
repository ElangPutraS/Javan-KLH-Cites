<?php

namespace App\Http\Controllers\Admin;

use App\AppendixSource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppendixSourceController extends Controller
{
    public function index(Request $request)
    {
        $code = '';
        $name = '';

        if($request->input('code') == '' && $request->input('name') == '' || $request->input('code') == null && $request->input('name') == null ){
            $appendix_sources = AppendixSource::orderBy('appendix_source_code', 'asc')->paginate(10);
        }else{
            $code = '%'.$request->input('code').'%';
            $name = '%'.$request->input('name').'%';

            $appendix_sources = AppendixSource::where('appendix_source_code', 'like', $code)
                ->where('description', 'like', $name)
                ->orderBy('appendix_source_code')->paginate(10);
        }


        return view('admin.appendixSource.index', compact('appendix_sources'));
    }
}
