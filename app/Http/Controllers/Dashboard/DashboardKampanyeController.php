<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DashboardKampanyeController extends Controller
{
    // Method to show the dashboard kampanye page
    public function index()
    {
        // Ambil artikel dan agenda user login
        $artikels = Artikel::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $agendas = Agenda::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik
        $totalArtikel = $artikels->count();
        $totalAgenda = $agendas->count();
        $totalArtikelAgenda = $artikels->count() + $agendas->count();

        return view('dashboard.kampanye.index', compact(
            'artikels',
            'agendas',
            'totalArtikel',
            'totalAgenda',
            'totalArtikelAgenda'
        ));
    }

    public function updateArtikel(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:Published,Draft',
        ]);

        // handle gambar
        if ($request->hasFile('gambar')) {
            // hapus gambar lama jika ada
            if ($artikel->gambar && File::exists(public_path($artikel->gambar))) {
                File::delete(public_path($artikel->gambar));
            }

            $file = $request->file('gambar');
            $filename = Str::slug($request->judul) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/artikel/' . $filename;
            $file->move(public_path('img/artikel'), $filename);
        } else {
            $path = $artikel->gambar; // tetap gambar lama
        }

        $data['gambar'] = $path;
        $data['slug'] = Str::slug($request->judul);

        $artikel->update($data);

        return redirect()->route('dashboard.kampanye.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function updateAgenda(Request $request, $slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string',
            'kuota' => 'required|integer',
            'status' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
                File::delete(public_path($agenda->gambar));
            }
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama_kegiatan) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/agenda/' . $filename;
            $file->move(public_path('img/agenda'), $filename);
        } else {
            $path = $agenda->gambar; // tetap gambar lama
        }

        $agenda->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'slug' => Str::slug($request->nama_kegiatan),
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'kuota' => $request->kuota,
            'status' => $request->status,
            'gambar' => $path,
        ]);

        return redirect()->route('dashboard.kampanye.index')->with('success', 'Agenda berhasil diupdate!');
    }
}
