<?php

namespace App\Http\Controllers\Admin;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    public function index()
    {
        $sources = Source::orderBy('source_code', 'asc')->paginate(10);

        return view('admin.source.index', compact('sources'));
    }
}
