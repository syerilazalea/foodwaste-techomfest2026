<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->alamat = $request->alamat;

        // ==== Update iframe maps otomatis ====
        if (!empty($request->alamat)) {
            $user->iframe_maps = "https://www.google.com/maps?q=" . urlencode($request->alamat) . "&output=embed";
        } else {
            $user->iframe_maps = null;
        }

        // ==== Handle gambar dengan Storage ====
        if ($request->hasFile('gambar')) {
            $defaultImage = 'img/user/default.png';

            // Hapus file lama jika ada dan bukan default.png
            if ($user->gambar && $user->gambar !== $defaultImage) {
                if (Storage::disk('public')->exists($user->gambar)) {
                    Storage::disk('public')->delete($user->gambar);
                }
            }

            // Simpan file baru
            $file = $request->file('gambar');
            $filename = Str::slug($user->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('img/user', $filename, 'public');

            // Simpan path ke database
            $user->gambar = 'img/user/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Update kontak (phone)
    public function updateKontak(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:10,13',
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
