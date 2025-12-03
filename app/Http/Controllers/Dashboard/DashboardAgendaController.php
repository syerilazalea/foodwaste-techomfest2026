<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class DashboardAgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('nama_kegiatan', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%");
        }

        $agendas = $query->orderBy('created_at', 'desc')->paginate(5);
        $agendas->appends($request->all());

        return view('dashboard.kampanye.tabelAgenda', compact('agendas'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
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

        $path = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama_kegiatan) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/agenda'), $filename);
            $path = 'img/agenda/' . $filename;
        }

        $deskripsi = Purifier::clean($request->deskripsi);

        Agenda::create([
            'user_id' => Auth::id(),
            'nama_kegiatan' => $request->nama_kegiatan,
            'slug' => Str::slug($request->nama_kegiatan),
            'deskripsi' => $deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'kuota' => $request->kuota,
            'status' => $request->status,
            'gambar' => $path,
        ]);

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil dibuat!');
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        // Debug: tampilkan semua request input
        // dd($request->all());

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

        // Default path tetap gambar lama
        $path = $agenda->gambar;

        // Debug: cek apakah file gambar dikirim
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            // Debug: info file
            info('File uploaded: ' . $file->getClientOriginalName());
            info('File type: ' . $file->getClientMimeType());
            info('File size: ' . $file->getSize());

            // Hapus file lama jika ada
            if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
                File::delete(public_path($agenda->gambar));
                info('Old file deleted: ' . $agenda->gambar);
            }

            $filename = Str::slug($request->nama_kegiatan) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/agenda'), $filename);

            $path = 'img/agenda/' . $filename;

            // Debug: path baru
            info('New file path: ' . $path);
        } else {
            info('No new file uploaded');
        }

        $deskripsi = Purifier::clean($request->deskripsi);

        $agenda->update([
            'user_id' => Auth::id(),
            'nama_kegiatan' => $request->nama_kegiatan,
            'slug' => Str::slug($request->nama_kegiatan),
            'deskripsi' => $deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'kuota' => $request->kuota,
            'status' => $request->status,
            'gambar' => $path,
        ]);

        info('Agenda updated successfully: ID ' . $agenda->id);

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil diupdate!');
    }



    // ================= DESTROY =================
    public function destroy($slug)
    {
        $agenda = Agenda::findOrFail($slug);

        if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
            File::delete(public_path($agenda->gambar));
        }

        $agenda->delete();

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
