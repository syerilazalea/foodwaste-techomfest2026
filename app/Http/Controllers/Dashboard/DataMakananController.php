<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataMakanan;
use App\Models\DataDaurUlang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DataMakananController extends Controller
{
    public function index()
    {
        // Saat index diakses, makanan yg expired otomatis pindah. Jadi gpke worker.
        $expiredMakanan = DataMakanan::where('batas_waktu', '<', Carbon::now()->format('H:i:s'))->get();
        $currentTime = Carbon::now();

        foreach ($expiredMakanan as $makanan) {
            DataDaurUlang::create([
                'user_id' => $makanan->user_id,
                'nama' => $makanan->nama,
                'penyedia' => $makanan->penyedia,
                'kategori' => $makanan->kategori,
                'alamat' => $makanan->alamat,
                'berat' => $makanan->porsi,
                'batas_waktu' => $makanan->batas_waktu,
                'gambar' => $makanan->gambar,
            ]);

            $makanan->delete();
        }

        $user = Auth::user();
        $dataMakanan = DataMakanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('dashboard.dashboard-makanan', compact('user', 'dataMakanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'porsi' => 'required|integer|min:1',
            'batas_waktu' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/dataMakanan/' . $filename;
            $file->move(public_path('img/dataMakanan'), $filename); // simpan di public/img/dataMakanan
        } else {
            $path = null;
        }

        dataMakanan::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'porsi' => $request->porsi,
            'batas_waktu' => $request->batas_waktu,
            'gambar' => $path, // path lengkap relatif public/
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function update(Request $request, DataMakanan $dataMakanan)
    {
        $user = Auth::user();

        if ($dataMakanan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah data ini.');
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'porsi' => 'required|integer|min:1',
            'batas_waktu' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        // Jika ada file baru, hapus lama dan simpan baru
        if ($request->hasFile('gambar')) {
            if ($dataMakanan->gambar && File::exists(public_path($dataMakanan->gambar))) {
                File::delete(public_path($dataMakanan->gambar));
            }
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/dataMakanan/' . $filename;
            $file->move(public_path('img/dataMakanan'), $filename);
        } else {
            $path = $dataMakanan->gambar; // tetap gambar lama
        }

        $dataMakanan->update([
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'porsi' => $request->porsi,
            'batas_waktu' => $request->batas_waktu,
            'gambar' => $path,
        ]);


        return redirect()->route('dashboard.dataMakanan.index')
            ->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy(DataMakanan $dataMakanan)
    {
        $user = Auth::user();

        if ($dataMakanan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus data ini.');
        }

        if ($dataMakanan->gambar && File::exists(public_path($dataMakanan->gambar))) {
            File::delete(public_path($dataMakanan->gambar));
        }

        $dataMakanan->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
