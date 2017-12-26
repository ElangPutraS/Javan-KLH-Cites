<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PurposeTypeStoreRequest;
use App\Http\Requests\PurposeTypeUpdateRequest;
use App\PurposeType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PurposeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = '';
        $name = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $purposetypes = PurposeType::orderBy('purpose_type_name', 'asc')->paginate(10);
        }else{
            if($request->input('c') != ''){
                $code = '%'.$request->input('c').'%';
            }

            if($request->input('n') != ''){
                $name = '%'.$request->input('n').'%';
            }

            $purposetypes = PurposeType::where('purpose_type_code', 'like', $code)
                ->orWhere('purpose_type_name', 'like', $name)
                ->orderBy('purpose_type_name')->paginate(10);
        }

        return view('admin.purposeType.index', compact('purposetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function create()
    {
        
        return view('admin.purposeType.create');
    }


      public function store(PurposeTypeStoreRequest $request){
        $purposetype= PurposeType::create([
            'purpose_type_code' => $request->get('purpose_type_code'),
            'purpose_type_name' => $request->get('purpose_type_name')
            ]);
        $purposetype->save();
        return redirect()->route('admin.purposeType.edit', $purposetype)->with('success', 'Data berhasil dibuat.');
    }

 

    public function edit($id) {

        $purposetype = PurposeType::find($id);

        return view('admin.purposeType.edit', compact('purposetype'));
    }


    public function update(PurposeTypeUpdateRequest $request, $id) {
        $purposetype=PurposeType::find($id);
        $purposetype->update([
            'purpose_type_code' => $request->get('purpose_type_code'),
            'purpose_type_name' => $request->get('purpose_type_name')
        ]);

        return redirect()->route('admin.purposeType.edit', ['id' => $purposetype->id])->with('success', 'Data berhasil diubah.');
    }


    public function destroy($id) {
        $purposetype=PurposeType::find($id);
        $purposetype->delete();


        return redirect()->route('admin.purposeType.index')->with('success', 'Data berhasil dihapus.');
    }

   

}

?>
