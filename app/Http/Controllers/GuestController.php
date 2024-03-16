<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        return view('absen');
    }
    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil, periksa level pengguna
            $user = Auth::user();

            if ($user->level === 'admin') {
                // Jika pengguna adalah admin, redirect ke halaman admin
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'siswa') {
                // Jika pengguna adalah Siswa, redirect ke halaman Siswa
                return redirect()->route('dashboard');
            } else {
                // Jika level tidak dikenali, kembali ke halaman login dengan pesan kesalahan
                return back()->with(['error', 'Level pengguna tidak valid']);
            }
        }

        // Jika login gagal, kembali ke halaman login dengan pesan kesalahan
        return back()->with(['error', 'Email atau Password Salah']);
    }
    
    public function logout()
    {
        auth()->logout(); // Logout user

        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
}
