<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class DashboardAgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();

        // filter search
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('nama_kegiatan', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%");
        }

        // urut terbaru
        $agendas = $query->orderBy('created_at', 'desc')->paginate(5);

        // supaya pagination tetap membawa keyword search
        $agendas->appends($request->all());

        return view('dashboard.kampanye.tabelAgenda', compact('agendas'));
    }

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

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama_kegiatan) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'img/agenda/' . $filename;
            $file->move(public_path('img/agenda'), $filename);
        } else {
            $path = null;
        }

        Agenda::create([
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

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil dibuat!');
    }

    public function update(Request $request, $slug)
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

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil diupdate!');
    }

    public function destroy($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();

        if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
            File::delete(public_path($agenda->gambar));
        }

        $agenda->delete();

        return redirect()->route('dashboard.agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
