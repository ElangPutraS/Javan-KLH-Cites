<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ports;
use App\Http\Requests\PortStoreRequest;
use App\Http\Requests\PortUpdateRequest;

class PortController extends \App\Http\Controllers\Controller {

	public function index(Request $request) {
		$code1 = ''; $code2= ''; $code3 = '';
		$name1 = ''; $name2 = ''; $name3 = '';

		if($request->input('c') == '' && $request->input('n') == '' || $request->input('c') == null && $request->input('n') == null ){
            $ports = Ports::orderBy('port_name')->paginate(10);
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

            $ports = Ports::where('port_code', 'like', $code1)
                ->orWhere('port_code', 'like', $code2)
                ->orWhere('port_code', 'like', $code3)
                ->orWhere('port_name', 'like', $name1)
                ->orWhere('port_name', 'like', $name2)
                ->orWhere('port_name', 'like', $name3)
                ->orderBy('port_name')->paginate(10);
        }

		return view('admin.ports.index', compact('ports'));
	}

	public function create() {
		return view('admin.ports.create', ['port' => null]);
	}

	public function store(PortStoreRequest $request) {
		$port = new Ports([
			'port_code' => $request->get('port_code'),
			'port_name' => $request->get('port_name')
		]);
		$port->save();

		return redirect()->route('admin.ports.edit', $port)->with('success', 'Data berhasil dibuat.');
	}

	public function edit(Ports $port) {
		return view('admin.ports.edit', compact('port'));
	}

	public function update(PortUpdateRequest $request, Ports $port) {
		$port->update([
			'port_code' => $request->get('port_code'),
			'port_name' => $request->get('port_name')
		]);

		return redirect()->route('admin.ports.edit', $port)->with('success', 'Data berhasil diubah.');
	}

	public function destroy(Ports $port) {
		$port->delete();

		return redirect()->route('admin.ports.index')->with('success', 'Data berhasil dihapus.');
	}
}