<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class DashboardArtikelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Artikel::query()->where('user_id', $user->id); // hanya agenda milik user login

        $artikels = Artikel::latest()->get();
        // urut terbaru
        $artikels = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.kampanye.tabelArtikel', compact('artikels'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('q'); // keyword search
        $status = $request->input('status'); // opsional, kalau ada filter status

        $artikels = Artikel::where('user_id', $user->id)
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%"); // search kategori juga
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'status' => $status,
                'q' => $keyword
            ]);

        return view('dashboard.partials.dashboard-tabel-artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:Published,Draft',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->judul) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $filename);
            $path = 'img/artikel/' . $filename;
        }

        Artikel::create([
            'judul' => $data['judul'],
            'slug' => Str::slug($data['judul']),
            'deskripsi' => Purifier::clean($data['deskripsi']),
            'kategori' => $data['kategori'],
            'status' => $data['status'],
            'gambar' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('dashboard.artikel.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        // ===== GAMBAR =====
        $path = $artikel->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($artikel->gambar && File::exists(public_path($artikel->gambar))) {
                File::delete(public_path($artikel->gambar));
            }

            $file = $request->file('gambar');
            $filename = Str::slug($request->judul) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $filename);

            $path = 'img/artikel/' . $filename;
        }

        // ===== UPDATE DATA =====
        $artikel->update([
            'judul' => $data['judul'],
            'slug' => Str::slug($data['judul']),
            'deskripsi' => Purifier::clean($data['deskripsi']),
            'kategori' => $data['kategori'],
            'gambar' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('dashboard.artikel.index')
            ->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('user_id', Auth::id()) // pastikan user hanya bisa hapus artikelnya sendiri
            ->firstOrFail();

        if ($artikel->gambar && File::exists(public_path($artikel->gambar))) {
            File::delete(public_path($artikel->gambar));
        }

        $artikel->delete();

        return redirect()->route('dashboard.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
