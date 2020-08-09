<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false;
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password],$remember)) {
            return redirect()->back()->with('pesan','username atau password salah');
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
