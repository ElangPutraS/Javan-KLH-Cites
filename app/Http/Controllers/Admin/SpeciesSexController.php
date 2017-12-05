<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpeciesSexStoreRequest;
use App\Http\Requests\SpeciesSexUpdateRequest;
use App\SpeciesSex;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SpeciesSexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speciessex = SpeciesSex::orderBy('sex_name', 'asc')->paginate(10);

        return view('admin.speciesSex.index', compact('speciessex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function create()
    {
        
        return view('admin.speciesSex.create');
    }


      public function store(SpeciesSexStoreRequest $request){
        $speciessex= SpeciesSex::create([
            'sex_code' => $request->get('sex_code'),
            'sex_name' => $request->get('sex_name')
            ]);
        $speciessex->save();
        return redirect()->route('admin.speciesSex.edit', $speciessex)->with('success', 'Data berhasil dibuat.');
    }

 

    public function edit($id) {
        $speciessex=SpeciesSex::find($id);

        return view('admin.speciesSex.edit', compact('speciessex'));
    }



    public function update(SpeciesSexUpdateRequest $request, $id) {
        $speciessex=SpeciesSex::find($id);
        $speciessex->update([
            'sex_code' => $request->get('sex_code'),
            'sex_name' => $request->get('sex_name')
        ]);

        return redirect()->route('admin.speciesSex.edit', $speciessex)->with('success', 'Data berhasil diubah.');
    }



    public function destroy($id) {
        $speciessex=SpeciesSex::find($id);
        $speciessex->delete();


        return redirect()->route('admin.speciesSex.index')->with('success', 'Data berhasil dihapus.');
    }
  

}

?>
