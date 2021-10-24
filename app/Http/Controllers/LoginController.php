<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Services\Login\RememberMeExpiration;

class LoginController extends Controller
{
    use RememberMeExpiration;

    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::validate($credentials)) {
            return back()->withInput()->with('message', [
                'icon'  => 'error',
                'title' => 'Invalid',
                'text'  => 'user credentials'
            ]);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->remember_me == 'true' ? TRUE : FALSE);

        if ($request->remember_me == 'true' ? TRUE : FALSE) {
            $this->setRememberMeExpiration($user);
        }

        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
