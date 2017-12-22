<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProvinceStoreRequest;
use App\Http\Requests\ProvinceUpdateRequest;
use App\Country;
use App\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code1 = ''; $code2= ''; $code3 = '';
        $name1 = ''; $name2 = ''; $name3 = '';

        if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $provinces = Province::orderBy('province_name', 'asc')->paginate(10);
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

            $provinces = Province::where('province_code', 'like', $code1)
                ->orWhere('province_code', 'like', $code2)
                ->orWhere('province_code', 'like', $code3)
                ->orWhere('province_name', 'like', $name1)
                ->orWhere('province_name', 'like', $name2)
                ->orWhere('province_name', 'like', $name3)
                ->orderBy('province_name')->paginate(10);
        }


        return view('admin.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function create()
    {
        $countries        = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        
        return view('admin.provinces.create', compact('countries'));
    }


      public function store(ProvinceStoreRequest $request){
        $provinces= Province::create([
            'country_id'     => $request->get('country_id'),
            'province_code' => $request->get('province_code'),
            'province_name' => $request->get('province_name')
            ]);
        $provinces->save();
        return redirect()->route('admin.provinces.edit', $provinces)->with('success', 'Data berhasil dibuat.');
    }

 

    public function edit(Province $province) {
        $countries        = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');

        return view('admin.provinces.edit', compact('province', 'countries'));
    }

    public function update(ProvinceUpdateRequest $request, Province $province) {
        $province->update([
            'country_id'     => $request->get('country_id'),
            'province_code' => $request->get('province_code'),
            'province_name' => $request->get('province_name')
        ]);

        return redirect()->route('admin.provinces.edit', $province)->with('success', 'Data berhasil diubah.');
    }


    public function destroy(Province $province) {
        $province->delete();


        return redirect()->route('admin.provinces.index')->with('success', 'Data berhasil dihapus.');
    }

   

}

?>
