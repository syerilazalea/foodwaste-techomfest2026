<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataDaurUlang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DataDaurUlangController extends Controller
{
    public function index()
    {
        // Hapus data 6jam
        $expiredDaurUlang = DataDaurUlang::where('batas_waktu', '<', Carbon::now()->subHours(6))->get();

        foreach ($expiredDaurUlang as $item) {
            if ($item->gambar && File::exists(public_path($item->gambar))) {
                File::delete(public_path($item->gambar));
            }
            $item->delete();
        }

        $user = Auth::user();
        $dataDaurUlang = DataDaurUlang::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.dashboard-daur-ulang', compact('user', 'dataDaurUlang'));
    }

    // search
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('q');

        // Gunakan paginate, agar pagination tetap jalan
        $dataDaurUlang = DataDaurUlang::where('user_id', $user->id)
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
        return view('dashboard.partials.tabel-data-daur-ulang', compact('dataDaurUlang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'berat' => 'required|numeric|min:0.1',
            'batas_waktu' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/dataDaurUlang/' . $filename;
            $file->move(public_path('img/dataDaurUlang'), $filename); // simpan di public/img/dataDaurUlang
        } else {
            $path = null;
        }

        DataDaurUlang::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'berat' => $request->berat,
            'batas_waktu' => $request->batas_waktu,
            'gambar' => $path, // path lengkap relatif public/
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function update(Request $request, DataDaurUlang $dataDaurUlang)
    {
        $user = Auth::user();

        if ($dataDaurUlang->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah data ini.');
        }
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'penyedia' => 'required|string|max:255',
            'kategori' => 'required|in:UMKM,Restoran,Hotel,Rumah Tangga',
            'berat' => 'required|numeric|min:0.1',
            'batas_waktu' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('edit_id', $dataDaurUlang->id); // penting untuk modal otomatis terbuka
        }

        // Jika ada file baru, hapus lama dan simpan baru
        if ($request->hasFile('gambar')) {
            if ($dataDaurUlang->gambar && File::exists(public_path($dataDaurUlang->gambar))) {
                File::delete(public_path($dataDaurUlang->gambar));
            }
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/dataDaurUlang/' . $filename;
            $file->move(public_path('img/dataDaurUlang'), $filename);
        } else {
            $path = $dataDaurUlang->gambar; // tetap gambar lama
        }

        $dataDaurUlang->update([
            'nama' => $request->nama,
            'penyedia' => $request->penyedia,
            'kategori' => $request->kategori,
            'alamat' => $user->alamat,
            'berat' => $request->berat,
            'batas_waktu' => $request->batas_waktu,
            'gambar' => $path,
        ]);


        return redirect()->route('dashboard.dataDaurUlang.index')
            ->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy(DataDaurUlang $dataDaurUlang)
    {
        $user = Auth::user();

        if ($dataDaurUlang->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus data ini.');
        }

        if ($dataDaurUlang->gambar && File::exists(public_path($dataDaurUlang->gambar))) {
            File::delete(public_path($dataDaurUlang->gambar));
        }

        $dataDaurUlang->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
