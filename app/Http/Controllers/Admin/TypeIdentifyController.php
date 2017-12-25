<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeIdentifyStoreRequest;
use App\Http\Requests\TypeIdentifyUpdateRequest;
use App\TypeIdentify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeIdentifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name1 = ''; $name2 = ''; $name3 = '';

        if( $request->input('n') == '' ||  $request->input('n') == null ){
            $type_identify = TypeIdentify::orderBy('type_identify_name', 'asc')->paginate(10);
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

            $type_identify = TypeIdentify::where('type_identify_name', 'like', $name1)
                ->orWhere('type_identify_name', 'like', $name2)
                ->orWhere('type_identify_name', 'like', $name3)
                ->orderBy('type_identify_name')->paginate(10);
        }
        

        return view('admin.typeIdentify.index', compact('type_identify'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

     */

       public function create()
    {
       
        return view('admin.typeIdentify.create', ['type_identify' => null]);
    }

        public function store(TypeIdentifyStoreRequest $request){
        $type_identify= TypeIdentify::create([
            'type_identify_name' => $request->get('type_identify_name'),
            ]);
        $type_identify->save();
        return redirect()->route('admin.typeIdentify.edit', $type_identify)->with('success', 'Data berhasil dibuat.');
    }

    public function edit($id){
        $type_identify=TypeIdentify::find($id);
        return view('admin.typeIdentify.edit',compact('type_identify'));
    }

    public function update(TypeIdentifyUpdateRequest $request, $id){
        $type_identify=TypeIdentify::find($id);
        $type_identify->update([
            'type_identify_name' => $request->get('type_identify_name')
        ]);
        return redirect()->route('admin.typeIdentify.edit', ['id' => $type_identify->id])->with('success', 'Data berhasil diubah.');
    }



    public function destroy($id)
    {
        $type_identify=TypeIdentify::find($id);
        $type_identify->delete();

        return redirect()->route('admin.typeIdentify.index')->with('success', 'Data berhasil dihapus.');
    }




      
}

?>
