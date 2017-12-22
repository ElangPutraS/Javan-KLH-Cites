<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\City;
use App\Country;
use App\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CountryController extends Controller
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
            $countries = Country::orderBy('country_name', 'asc')->paginate(10);
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

            $countries = Country::where('country_code', 'like', $code1)
                ->orWhere('country_code', 'like', $code2)
                ->orWhere('country_code', 'like', $code3)
                ->orWhere('country_name', 'like', $name1)
                ->orWhere('country_name', 'like', $name2)
                ->orWhere('country_name', 'like', $name3)
                ->orderBy('country_code')->paginate(10);
        }



        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function create()
    {
       
        return view('admin.countries.create', ['countries' => null]);
    }

      public function store(CountryStoreRequest $request){
        $countries= Country::create([
            'country_code' => $request->get('country_code'),
            'country_name' => $request->get('country_name'),
            ]);
        $countries->save();
        return redirect()->route('admin.countries.edit', $countries)->with('success', 'Data berhasil dibuat.');
    }

 

    public function edit(Country $country) {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country) {
        $country->update([
            'country_code' => $request->get('country_code'),
            'country_name' => $request->get('country_name')
        ]);

        return redirect()->route('admin.countries.edit', $country)->with('success', 'Data berhasil diubah.');
    }


    public function destroy(Country $country) {
        $country->delete();


        return redirect()->route('admin.countries.index')->with('success','Data berhasil dihapus.');
    }

   

}

?>
