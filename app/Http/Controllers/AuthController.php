<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
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
        if (Setting::all()->count() < 4) {
            Setting::truncate();
            Setting::insert([
                ['name' => 'bank', 'value' => 'BCA'],
                ['name' => 'norek', 'value' => '123456789'],
                ['name' => 'pemilik', 'value' => 'John Doe'],
                ['name' => 'ongkir', 'value' => '10000'],
            ]);
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
                'user' => $u,
                'token' => $token,
            ], 200);
        }
        return response()->json([
            'message' => 'Username atau Password salah',
        ], 401);

    }

    public function userLogout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }

    public function userRegister(Request $req)
    {
        $c = new User();
        $c->name = $req->name;
        $c->email = $req->email;
        $c->password = bcrypt($req->password);
        $c->phone = $req->phone;
        $c->pict = 'default.png';
        $c->save();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }
}
