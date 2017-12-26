<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $code = '';
        $name = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $categories =Category::orderBy('species_category_name','asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code = '%'.$request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name = '%'.$request->input('n').'%';
            }

            $categories = Category::where('species_category_code', 'like', $code)
                ->orWhere('species_category_name', 'like', $name)
                ->orderBy('species_category_name')->paginate(10);
        }

       return view('admin.species.category', compact('categories'));
    }

    public function create(){
        return view('admin.species.createcategory');
    }

    public function store(CategoryStoreRequest $request){
        $categories=new Category([
            'species_category_code' => $request->get('species_category_code'),
            'species_category_name' => $request->get('category_name'),
        ]);
        $categories->save();

        return redirect()->route('admin.species.editCategory', ['id' => $categories->id])->with('success', 'Data berhasil dibuat.');
    }

    public function edit($id){
        $categories=Category::find($id);
        return view('admin.species.editCategory',compact('categories'));
    }

    public function update(CategoryUpdateRequest $request, $id){
        $categories=Category::find($id);
        $categories->update([
            'species_category_code' => $request->get('species_category_code'),
            'species_category_name' => $request->get('category_name'),
        ]);
        return redirect()->route('admin.species.editCategory', ['id' => $categories->id])->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $categories=Category::find($id);
        $categories->delete();

        return redirect()->route('admin.species.category')->with('success', 'Data berhasil dihapus.');
    }

}

