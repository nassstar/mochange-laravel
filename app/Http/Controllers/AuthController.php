<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function login()
    {
        return view('login');
    }

    // Memproses data login (Pengganti query manual PHP Native)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Sihir Laravel: Auth::attempt akan otomatis ngecek email & password ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin'); // Jika benar, masuk ke admin
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Email atau Password salah!');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Setelah logout, kembali ke beranda
    }
}
