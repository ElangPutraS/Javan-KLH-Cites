<?php

namespace App\Http\Controllers\admin;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
       $categories =Categories::orderBy('species_category_code','asc')->paginate(10);
       return view('admin.species.category', compact('categories'));
    }

    public function create(){
        return view('admin.species.createCategory');
    }

    public function store(Request $request){
        $categories=new Categories([
            'species_category_code' => $request->get('category_code'),
            'species_category_name' => $request->get('category_name'),
        ]);
        $categories->save();

        return redirect()->route('admin.species.editCategory', ['id' => $categories->id])->with('success', 'Data berhasil ditambah.');
    }

    public function edit($id){
        $categories=Categories::find($id);
        return view('admin.species.editCategory',compact('categories'));
    }

    public function update(Request $request, $id){
        $categories=Categories::find($id);
        $categories->update([
            'species_category_code' => $request->get('category_code'),
            'species_category_name' => $request->get('category_name'),
        ]);
        return redirect()->route('admin.species.editCategory', ['id' => $categories->id])->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $categories=Categories::find($id);
        $categories->delete();

        return redirect()->route('admin.species.category')->with('success', 'Data berhasil dihapus.');
    }

}

