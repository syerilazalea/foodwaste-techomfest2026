<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    // Tampilkan profil
    public function profile()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        return view('settings.index', compact('user'));
    }

    // Update profil (nama & alamat)
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->alamat = $request->alamat;

        // ==== Tambahkan pembuatan iframe maps otomatis ====
        if (!empty($request->alamat)) {
            $encoded = urlencode($request->alamat);
            $user->iframe_maps = "https://www.google.com/maps?q=" . $encoded . "&output=embed";
        } else {
            $user->iframe_maps = null; // kosongkan jika alamat kosong
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Update kontak (phone)
    public function updateKontak(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui.');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = $request->password; // akan otomatis hash jika ada mutator di model
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
