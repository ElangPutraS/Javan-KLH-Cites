<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PurposeTypeStoreRequest;
use App\Http\Requests\ProvinceUpdateRequest;
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
    public function index()
    {
        $purposetypes = PurposeType::orderBy('purpose_type_name', 'asc')->paginate(10);

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
        $purposetypes= PurposeType::create([
            'purpose_type_code' => $request->get('purpose_type_code'),
            'purpose_type_name' => $request->get('purpose_type_name')
            ]);
        $purposetypes->save();
        return redirect()->route('admin.purposeType.create', $purposetypes)->with('success', 'Data berhasil dibuat.');
    }

 

    public function edit(PurposeType $purposetype) {

        return view('admin.purposeType.edit', compact('purposetype'));
    }

    public function update(ProvinceUpdateRequest $request, Province $province) {
        $province->update([
            'country_id'     => $request->get('country_id'),
            'province_code' => $request->get('province_code'),
            'province_name' => $request->get('province_name')
        ]);

        return redirect()->route('admin.provinces.edit', $province)->with('success', 'Data berhasil diubah.');
    }


    public function destroy(PurposeType $purposetype) {
        $purposetype->delete();


        return redirect()->route('admin.purposeType.index')->with('success', 'Data berhasil dihapus.');
    }

   

}

?>
