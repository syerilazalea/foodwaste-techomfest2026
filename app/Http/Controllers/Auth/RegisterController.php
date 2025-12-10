<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'role' => 'required|in:user,aktivis',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'nullable|required_if:role,user|string|max:255',
            'organisasi' => 'nullable|required_if:role,aktivis|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ==== Handle gambar dengan Storage ====
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            // Simpan ke storage/app/public/img/user
            $file->storeAs('public/img/user', $filename);
            $gambar = 'img/user/' . $filename; // path untuk DB
        } else {
            $gambar = 'img/user/default.png'; // default image
        }


        // === Generate iframe maps untuk role USER ===
        $iframe = null;
        if ($request->role === 'user' && $request->alamat) {
            $iframe = "https://www.google.com/maps?q=" . urlencode($request->alamat) . "&output=embed";
        }

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password, // langsung string, mutator akan hash otomatis
            'role' => $request->role,
            'alamat' => $request->alamat,
            'organisasi' => $request->organisasi,
            'gambar' => $gambar,
            'iframe_maps' => $iframe,
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
