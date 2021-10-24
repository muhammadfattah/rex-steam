<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile'
        ]);
    }

    public function update(Request $request)
    {
        if ($request->profile) {
            $rules['profile'] = 'required|file|mimes:jpg,png|max:100';
        }
        if ($request->new_password) {
            $rules['new_password']         = 'required|min:6|alpha_num';
            $rules['confirm_new_password'] = 'required|same:new_password';
        }
        $rules['current_password'] = 'required|min:6|alpha_num';
        $rules['fullname']         = 'required';

        $request->validate($rules);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('message', [
                'icon'  => 'error',
                'title' => 'Invalid',
                'text'  => 'user credentials'
            ])->withInput();
        }

        if ($request->profile) {
            if ($user->profile != 'public/profile/default.jpg') {
                Storage::delete($user->profile);
            }
            $user->profile = $request->profile->store('public/profile');
        }

        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->fullname = $request->fullname;

        $user->save();

        return redirect('/profile')->with('message', [
            'icon'  => 'success',
            'title' => 'Profile',
            'text'  => 'updated successfully'
        ]);
    }
}
