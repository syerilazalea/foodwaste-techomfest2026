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
        $query = Artikel::query();

        $artikels = Artikel::latest()->get();
        // urut terbaru
        $artikels = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.kampanye.tabelArtikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:Published,Draft',
        ]);

        $path = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->judul) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $filename);
            $path = 'img/artikel/' . $filename;
        }

        $data['deskripsi'] = Purifier::clean($request->deskripsi);
        $data['gambar'] = $path;
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();

        Artikel::create($data);

        return redirect()->route('dashboard.artikel.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:Published,Draft',
        ]);

        // Default path tetap gambar lama
        $path = $artikel->gambar;

        // Debug: cek apakah file gambar dikirim
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            // Debug: info file
            info('File uploaded: ' . $file->getClientOriginalName());
            info('File type: ' . $file->getClientMimeType());
            info('File size: ' . $file->getSize());

            // Hapus file lama jika ada
            if ($artikel->gambar && File::exists(public_path($artikel->gambar))) {
                File::delete(public_path($artikel->gambar));
                info('Old file deleted: ' . $artikel->gambar);
            }

            $filename = Str::slug($request->judul) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $filename);

            $path = 'img/artikel/' . $filename;

            // Debug: path baru
            info('New file path: ' . $path);
        } else {
            info('No new file uploaded');
        }

        $data['deskripsi'] = Purifier::clean($request->deskripsi);
        $data['gambar'] = $path;
        $data['slug'] = Str::slug($request->judul);

        $artikel->update($data);

        return redirect()->route('dashboard.artikel.index')->with('success', 'Artikel berhasil diupdate.');
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
