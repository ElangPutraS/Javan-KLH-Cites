<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use App\City;
use App\Country;
use App\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CityController extends Controller
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
            $cities = City::orderBy('city_name', 'asc')->paginate(10);
        }else{
            $code = '%'.$request->input('c').'%';
            $name = '%'.$request->input('n').'%';

            $cities = City::where('city_code', 'like', $code)
                ->where('city_name_full', 'like', $name)
                ->orderBy('city_name')->paginate(10);
        }

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function create()
    {
        $provinces        = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
       
        return view('admin.cities.create', compact( 'provinces'));
    }

      public function store(CityStoreRequest $request){
        $cities= City::create([
            'city_code' => $request->get('city_code'),
            'city_name' => $request->get('city_name'),
            'city_name_full' => $request->get('city_name_full'),
            'province_id' => $request->get('province_id'),
            ]);
        $cities->save();
        return redirect()->route('admin.cities.edit', $cities)->with('success', 'Data berhasil dibuat.');
    }
 

    public function edit(City $city) {
        $provinces        = Province::orderBy('province_name', 'asc')->pluck('province_name', 'id');
       
        return view('admin.cities.edit', compact('city','provinces'));
    }

    public function update(CityUpdateRequest $request, City $city) {
        $city->update([
            'city_code' => $request->get('city_code'),
            'city_name' => $request->get('city_name'),
            'city_name_full' => $request->get('city_name_full'),
            'province_id' => $request->get('province_id'),
        ]);

        return redirect()->route('admin.cities.edit', $city)->with('success', 'Data berhasil diubah.');
    }


    public function destroy(City $city) {
        $city->delete();


        return redirect()->route('admin.cities.index')->with('success','Data berhasil dihapus.');
    }

   

}

?>
