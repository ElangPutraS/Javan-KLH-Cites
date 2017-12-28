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

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $sources = Source::orderBy('source_code', 'asc')->paginate(10);
        }else{
            $code = '%'.$request->input('c').'%';
            $name = '%'.$request->input('n').'%';

            $sources = Source::where('source_code', 'like', $code)
                ->where('source_description', 'like', $name)
                ->orderBy('source_code')->paginate(10);
        }

        return view('admin.source.index', compact('sources'));
    }
}
