<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (Admin::all()->count() < 1) {
            $a = new Admin();
            $a->name = "Administrator";
            $a->email = "admin@localhost";
            $a->password = bcrypt('123');
            $a->save();
        }
        return view('auth.login');
    }

    public function loginCheck(Request $req)
    {
        $cred = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($cred)) {
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

    public function userLogin(Request $req)
    {
        $u = User::where('email', $req->email)->first();
        if ($u && Hash::check($req->password, $u->password)) {
            $token = $u->createToken('auth-user')->plainTextToken;
            return response()->json([
                'token' => $token,
            ], 200);
        }

    }
}
