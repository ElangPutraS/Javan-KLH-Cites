<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordUserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
        ]);

        $user = $request->user();

        if ($request->get('old_password') && $request->get('new_password') && $request->get('confirm_password') !== NULL){
            if (!Hash::check($request->get('old_password'), $user->password)) {
                return redirect()->route('profile.editPassword')->with('warning', 'Password Tidak Sama');
            }
            else{
                $user->update([
                    'password' => bcrypt($request->get('new_password')),
                ]);
            }
        }

        return redirect()->route('profile.editPassword')->with('success', 'Password berhasil diubah.');
    }
}
