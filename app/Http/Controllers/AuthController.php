<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function loginCheck(Request $req)
    {
        $cred = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($cred)) {
            $req->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Gagal Login, email atau password salah');
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect()->route('login');
    }
}
