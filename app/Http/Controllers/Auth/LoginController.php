<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Credentials
        $credentials = [
            'email' => trim($request->email),
            'password' => $request->password,
        ];

        // Checkbox remember
        $remember = $request->boolean('rememberCheck');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Berhasil login! Selamat datang kembali.');
        }

        // Jika gagal
        return back()
            ->with('error', 'Email atau password salah.')
            ->withInput();
    }
}
