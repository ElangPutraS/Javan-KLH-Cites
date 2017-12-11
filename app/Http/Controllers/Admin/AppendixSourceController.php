<?php

namespace App\Http\Controllers\Admin;

use App\AppendixSource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppendixSourceController extends Controller
{
    public function index()
    {
        $appendix_sources = AppendixSource::orderBy('appendix_source_code', 'asc')->paginate(10);

        return view('admin.appendixSource.index', compact('appendix_sources'));
    }
}
