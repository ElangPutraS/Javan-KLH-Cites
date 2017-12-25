<?php

namespace App\Http\Controllers\Admin;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    public function index(Request $request)
    {
        $code1 = ''; $code2= ''; $code3 = '';
        $name1 = ''; $name2 = ''; $name3 = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $sources = Source::orderBy('source_code', 'asc')->paginate(10);
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

            $sources = Source::where('source_code', 'like', $code1)
                ->orWhere('source_code', 'like', $code2)
                ->orWhere('source_code', 'like', $code3)
                ->orWhere('source_description', 'like', $name1)
                ->orWhere('source_description', 'like', $name2)
                ->orWhere('source_description', 'like', $name3)
                ->orderBy('source_code')->paginate(10);
        }

        return view('admin.source.index', compact('sources'));
    }
}
