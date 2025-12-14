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
use Carbon\Carbon;

class DataMakananController extends Controller
{
    public function index()
    {
        $now = now();

        $expiredMakanan = DataMakanan::where('batas_waktu', '<', $now)->get();

        DB::transaction(function () use ($expiredMakanan, $now) {

            $targetDir = public_path('img/dataDaurUlang');

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            foreach ($expiredMakanan as $makanan) {

                // DEFAULT path lama
                $newImagePath = null;

                if ($makanan->gambar && File::exists(public_path($makanan->gambar))) {

                    $oldPath = public_path($makanan->gambar);

                    $filename = basename($makanan->gambar);

                    $newPath = 'img/dataDaurUlang/' . $filename;

                    // pindahkan file
                    File::move($oldPath, public_path($newPath));

                    $newImagePath = $newPath;
                }

                // simpan ke daur ulang
                DataDaurUlang::create([
                    'user_id' => $makanan->user_id,
                    'data_makanan_id' => $makanan->id,
                    'nama' => $makanan->nama,
                    'penyedia' => $makanan->penyedia,
                    'kategori' => $makanan->kategori,
                    'alamat' => $makanan->alamat,
                    'berat' => $makanan->porsi,
                    'batas_waktu' => $makanan->batas_waktu,
                    'gambar' => $newImagePath, // PATH BARU
                ]);

                // simpan ke expired
                DataExpired::create([
                    'user_id' => $makanan->user_id,
                    'data_makanan_id' => $makanan->id,
                    'expired_at' => $now,
                ]);

                // hapus data makanan (file sudah dipindah)
                $makanan->delete();
            }
        });

        $user = Auth::user();

        $dataMakanan = DataMakanan::where('user_id', $user->id)
            ->latest()
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
            'batas_waktu' => [
                'required',
                'date',
                function ($attr, $value, $fail) {
                    if (Carbon::parse($value)->lessThanOrEqualTo(now())) {
                        $fail('Batas waktu harus lebih besar dari waktu sekarang.');
                    }
                }
            ],
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        $path = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/dataMakanan'), $filename);
            $path = 'img/dataMakanan/' . $filename;
        }

        DataMakanan::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'porsi' => $request->porsi,
            'batas_waktu' => Carbon::parse($request->batas_waktu),
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function update(Request $request, DataMakanan $dataMakanan)
    {
        $user = Auth::user();

        if ($dataMakanan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah data ini.');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'porsi' => 'required|integer|min:1',
            'batas_waktu' => [
                'required',
                'date',
                function ($attr, $value, $fail) {
                    if (Carbon::parse($value)->lessThanOrEqualTo(now())) {
                        $fail('Batas waktu harus lebih besar dari waktu sekarang.');
                    }
                }
            ],
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('edit_id', $dataMakanan->id)
                ->withErrors($validator)
                ->withInput();
        }

        // ===== GAMBAR =====
        $path = $dataMakanan->gambar;

        if ($request->hasFile('gambar')) {
            if ($dataMakanan->gambar && File::exists(public_path($dataMakanan->gambar))) {
                File::delete(public_path($dataMakanan->gambar));
            }

            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/dataMakanan'), $filename);
            $path = 'img/dataMakanan/' . $filename;
        }

        $dataMakanan->update([
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'porsi' => $request->porsi,
            'batas_waktu' => Carbon::parse($request->batas_waktu),
            'gambar' => $path,
        ]);

        return redirect()
            ->route('dashboard.dataMakanan.index')
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
