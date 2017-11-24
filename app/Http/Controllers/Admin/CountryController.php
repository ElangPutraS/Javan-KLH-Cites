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
    public function index()
    {
        $countries = Country::orderBy('country_name', 'asc')->paginate(10);

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
        return redirect()->route('admin.countries.edit', $countries)->with('success', 'Data berhasil ditambah.');
    }

    public function show(Country $country) {
    echo json_encode($country);
  }

    public function edit(Country $country) {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country) {
        $country->update([
            'country_code' => $request->get('country_code'),
            'country_name' => $request->get('country_name')
        ]);

        return redirect()->route('admin.countries.edit', $country)->with('success', 'Data berhasil disimpan.');
    }


    public function destroy(Country $country) {
        $country->delete();

        DB::statement('ALTER TABLE countries AUTO_INCREMENT = 1');

        return redirect()->route('admin.countries.index')->with('Data berhasil dihapus.');
    }

   

}

?>
