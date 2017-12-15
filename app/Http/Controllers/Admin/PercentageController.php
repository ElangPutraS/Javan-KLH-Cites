<?php

namespace App\Http\Controllers\Admin;

use App\Percentage;
use Illuminate\Http\Request;

class PercentageController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $percentages = Percentage::orderBy('id', 'asc')->paginate(10);

        return view('admin.percentage.index', compact('percentages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.percentage.create', ['port' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'name' => "required|max:64",
            'value' => 'required|numeric|max:3'
        ]);

        $percentage = new Percentage([
            'name' => $request->get('name'),
            'value' => $request->get('value')
        ]);
        $percentage->save();

        return redirect()->route('admin.percentage.edit', $percentage)->with('success', 'Data berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function show(Percentage $percentage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function edit(Percentage $percentage)
    {
        //
        return view('admin.percentage.edit', compact('percentage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Percentage $percentage)
    {
        //
        $validator = $request->validate([
            'name' => "required|max:64",
            'value' => 'required|numeric|max:3'
        ]);

        $percentage->update([
            'name' => $request->get('name'),
            'value' => $request->get('value')
        ]);

        return redirect()->route('admin.percentage.edit', $percentage)->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Percentage  $percentage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Percentage $percentage)
    {
        //
        $percentage->delete();

        return redirect()->route('admin.percentage.index')->with('success', 'Data berhasil dihapus.');
    }
}
