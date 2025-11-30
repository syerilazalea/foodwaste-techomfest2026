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

        // Ambil credentials
        $credentials = [
            'email' => trim($request->email),
            'password' => $request->password,
        ];

        // Cek checkbox "remember me"
        $remember = $request->has('rememberCheck');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // regenerasi session untuk keamanan
            return redirect()->route('dashboard.index'); // redirect ke dashboard.index
        }

        // Login gagal
        return back()->withErrors([
            'loginError' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
}
