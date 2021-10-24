<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:6|unique:users',
            'fullname' => 'required',
            'password' => 'required|min:6|alpha_num',
            'role'     => 'required',
        ]);

        $validatedData['username'] = strtolower($validatedData['username']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['profile']  = 'public/profile/default.jpg';
        User::create($validatedData);

        return redirect('/')->with('message', [
            'icon'  => 'success',
            'title' => 'Registration',
            'text'  => 'Successfully'
        ]);
    }
}
