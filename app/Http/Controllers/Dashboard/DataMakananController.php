<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataMakanan;
use App\Models\DataDaurUlang;
use App\Models\DataExpired;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DataMakananController extends Controller
{
    public function index()
    {
        $now = now();
        $nowTime = $now->format('H:i:s');

        // Ambil makanan yang sudah lewat batas waktu
        $expiredMakanan = DataMakanan::whereTime('batas_waktu', '<', $nowTime)->get();

        DB::transaction(function () use ($expiredMakanan, $now) {
            foreach ($expiredMakanan as $makanan) {
                // Simpan data ke tabel daur ulang
                DataDaurUlang::create([
                    'user_id' => $makanan->user_id,
                    'data_makanan_id' => $makanan->id, // tetap disimpan
                    'nama' => $makanan->nama,
                    'penyedia' => $makanan->penyedia,
                    'kategori' => $makanan->kategori,
                    'alamat' => $makanan->alamat,
                    'berat' => $makanan->porsi,
                    'batas_waktu' => $makanan->batas_waktu,
                    'gambar' => $makanan->gambar,
                ]);

                // Simpan data ke tabel expired
                DataExpired::create([
                    'user_id' => $makanan->user_id,
                    'data_makanan_id' => $makanan->id, // tetap disimpan
                    'expired_at' => $now,
                ]);

                // Hapus data makanan dari tabel utama
                $makanan->delete();
            }
        });

        // Ambil data makanan yang masih tersisa
        $user = Auth::user();
        $dataMakanan = DataMakanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.dashboard-makanan', compact('user', 'dataMakanan'));
    }

    // search
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('q');

        // Gunakan paginate, agar pagination tetap jalan
        $dataMakanan = DataMakanan::where('user_id', $user->id)
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('nama', 'LIKE', "%{$query}%")
                        ->orWhere('penyedia', 'LIKE', "%{$query}%")
                        ->orWhere('kategori', 'LIKE', "%{$query}%")
                        ->orWhere('alamat', 'LIKE', "%{$query}%");
                });
            })
            ->orderBy('nama', 'asc')
            ->paginate(10)
            ->appends(['q' => $query]); // biar pagination bawa query search

        // return partial blade
        return view('dashboard.partials.tabel-data-makanan', compact('dataMakanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'porsi' => 'required|integer|min:1',
            'batas_waktu' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
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

        // VALIDASI MANUAL
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'porsi' => 'required|integer|min:1',
            'batas_waktu' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('edit_id', $dataMakanan->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($dataMakanan->gambar && File::exists(public_path($dataMakanan->gambar))) {
                File::delete(public_path($dataMakanan->gambar));
            }
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/dataMakanan/' . $filename;
            $file->move(public_path('img/dataMakanan'), $filename);
        } else {
            $path = $dataMakanan->gambar;
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
