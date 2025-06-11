<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Jika pengguna sudah login, arahkan ke halaman utama
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    /**
     * Memproses request login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk mengautentikasi pengguna
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Regenerasi session ID untuk keamanan

            // Arahkan pengguna berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin')->with('success', 'Selamat datang, Admin!'); // Notifikasi untuk admin
            }

            // Notifikasi sukses login untuk pengguna biasa
            return redirect()->intended('/')->with('success', 'Anda berhasil login!');
        }

        // Jika autentikasi gagal, lemparkan exception validasi
        throw ValidationException::withMessages([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    /**
     * Melakukan logout pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        $request->session()->invalidate(); // Batalkan session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        // Notifikasi sukses logout
        return redirect('/')->with('success', 'Anda berhasil logout!');
    }
}
