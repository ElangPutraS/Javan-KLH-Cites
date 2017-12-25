<?php

namespace App\Http\Controllers\Admin;

use App\AppendixSource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppendixSourceController extends Controller
{
    public function index(Request $request)
    {
        $code1 = ''; $code2= ''; $code3 = '';
        $name1 = ''; $name2 = ''; $name3 = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $appendix_sources = AppendixSource::orderBy('appendix_source_code', 'asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code1 = '%'.$request->input('c');
                $code2 = '%'.$request->input('c').'%';
                $code3 = $request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name1 = '%'.$request->input('n');
                $name2 = '%'.$request->input('n').'%';
                $name3 = $request->input('n').'%';
            }

            $appendix_sources = AppendixSource::where('appendix_source_code', 'like', $code1)
                ->orWhere('appendix_source_code', 'like', $code2)
                ->orWhere('appendix_source_code', 'like', $code3)
                ->orWhere('description', 'like', $name1)
                ->orWhere('description', 'like', $name2)
                ->orWhere('description', 'like', $name3)
                ->orderBy('appendix_source_code')->paginate(10);
        }


        return view('admin.appendixSource.index', compact('appendix_sources'));
    }
}
