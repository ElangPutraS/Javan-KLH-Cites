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

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $appendix_sources = AppendixSource::orderBy('appendix_source_code', 'asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code = '%'.$request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name = '%'.$request->input('n').'%';
            }

            $appendix_sources = AppendixSource::where('appendix_source_code', 'like', $code)
                ->orWhere('description', 'like', $name)
                ->orderBy('appendix_source_code')->paginate(10);
        }


        return view('admin.appendixSource.index', compact('appendix_sources'));
    }
}
