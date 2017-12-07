<?php

namespace App\Http\Controllers\admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    public function index(Request $request ){
        $user = User::withTrashed()->orderBy('name','asc')->paginate(10);
        return view('superadmin.index', compact('user'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.index')->with('success', 'Data berhasil dihapus.');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();

        return redirect()->route('superadmin.index')->with('success', 'Data berhasil.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = Role::orderBy('role_name','asc')->pluck('role_name','id');;
        return view('superadmin.edit',compact('user','role'));
    }

    public function update(Request $request,$id)
    {
        if($request->old_role_name != $request->role_name){
            $user = User::findOrFail($id);
            $user->roles()->detach($request->old_role_name);

            $role = Role::find($request->role_name);
            $user->roles()->attach($role);
        }else{
            $user = User::findOrFail($id);
            $user->roles()->updateExistingPivot($request->role_name);
        }
        return redirect()->route('superadmin.editUser', $user)->with('success', 'Data berhasil diubah.');
    }
}
