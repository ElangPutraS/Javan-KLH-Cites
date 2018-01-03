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
        $code = $request->input('code');
        $name = $request->input('name');

        $countries = Country::query();

        if($request->filled('code')){
            $countries = $countries->where('country_code', 'like', '%'.$code.'%');
        }

        if($request->filled('name')){
            $countries = $countries->where('country_name', 'like', '%'.$name.'%');
        }

        $countries = $countries->orderBy('country_code')->paginate(10);

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
