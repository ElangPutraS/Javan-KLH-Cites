<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ports;
use App\Http\Requests\PortStoreRequest;
use App\Http\Requests\PortUpdateRequest;

class PortController extends \App\Http\Controllers\Controller {

	public function index(Request $request) {
		$code = $request->input('code');
		$name = $request->input('name');

		$ports = Ports::query();

        if($request->filled('code')){
            $ports = $ports->where('port_code', 'like', '%'.$code.'%');
        }

        if($request->filled('name')){
            $ports = $ports->where('port_name', 'like', '%'.$name.'%');
        }

        $ports = $ports->orderBy('port_name')->paginate(10);

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