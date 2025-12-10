<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\DataDaurUlang;
use App\Models\DataMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomePageController extends Controller
{
    public function index()
    {
        $cekStatusArtikel = ['Published', 'Draft'];

        // Ambil artikel terbaru maksimal 7 hari terakhir
        $artikels = Artikel::where('created_at', '>=', Carbon::now()->subDays(7))
            ->whereIn('status', $cekStatusArtikel)
            ->where('status', 'Published')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil 5 data terbaru dari masing-masing model
        $makanan = DataMakanan::latest()->take(5)->get();
        $daurUlang = DataDaurUlang::latest()->take(5)->get();
        // menggambil data makanan dan daur ulang dari terbaru sampai terlama
        $dataItem = $makanan->merge($daurUlang)->sortByDesc('created_at');

        return view('home.index', compact('artikels', 'dataItem'));
    }

    public function tentangKami()
    {
        return view('home.tentangKami');
    }

    public function kampanye()
    {
        $cekStatusArtikel = ['Published', 'Draft'];
        $cekStatusAgenda = ['Aktif', 'Nonaktif'];

        $totalArtikel = Artikel::whereIn('status', $cekStatusArtikel)
            ->where('status', 'Published')
            ->count();

        $totalAgenda = Agenda::whereIn('status', $cekStatusAgenda)
            ->where('status', 'Aktif')
            ->count();

        // Ambil semua artikel terbaru yang memiliki status Published
        $artikels = Artikel::whereIn('status', $cekStatusArtikel)
            ->where('status', 'Published')
            ->orderBy('created_at', 'desc')->take(4)->get(); // Ambil 4 pertama

        // Ambil semua agenda terbaru
        $agendas = Agenda::whereIn('status', $cekStatusAgenda)
            ->where('status', 'Aktif')
            ->orderBy('created_at', 'desc')->take(4)->get(); // Ambil 4 pertama

        return view('home.kampanye.index', compact('artikels', 'agendas', 'totalArtikel','totalAgenda'));
    }

    // Route AJAX untuk load more
    public function loadMoreArtikel(Request $request)
    {
        $cekStatusArtikel = ['Published', 'Draft'];
        $skip = $request->skip;
        $artikels = Artikel::whereIn('status', $cekStatusArtikel)
            ->where('status', 'Published')
            ->orderBy('created_at', 'desc')
            ->skip($skip)
            ->take(4)
            ->get();

        $html = '';

        foreach ($artikels as $artikel) {
            $html .= '<div class="col">';
            $html .= '<a href="' . route('home.artikel.show', $artikel->slug) . '" class="text-decoration-none">';
            $html .= '<div class="card m-2 h-100">';
            if ($artikel->gambar) {
                $html .= '<img src="' . asset($artikel->gambar) . '" class="card-img-top sh-20" alt="' . $artikel->judul . '">';
            } else {
                $html .= '<img src="' . asset("img/default-artikel.webp") . '" class="card-img-top sh-20" alt="default image">';
            }
            $html .= '<div class="card-body">';
            $html .= '<h5 class="card-title">' . $artikel->judul . '</h5>';
            $html .= '<p class="card-text">' . \Illuminate\Support\Str::limit($artikel->konten, 100) . '</p>';
            $html .= '<div class="text-muted small"><i data-acorn-icon="clock" class="me-1"></i> ' . \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() . '</div>';
            $html .= '</div></div></a></div>';
        }

        return response()->json(['html' => $html, 'count' => $artikels->count()]);
    }

    public function loadMoreAgenda(Request $request)
    {
        $cekStatusAgenda = ['Aktif', 'Nonaktif'];

        $skip = $request->skip;

        $agendas = Agenda::whereIn('status', $cekStatusAgenda)
            ->where('status', 'Aktif')
            ->orderBy('created_at', 'desc')
            ->skip($skip)
            ->take(4)
            ->get();

        $html = '';

        foreach ($agendas as $agenda) {
            $html .= '<div class="col">';
            $html .= '<div class="card sh-35 hover-img-scale-up hover-reveal">';
            if ($agenda->gambar) {
                $html .= '<img src="' . asset($agenda->gambar) . '" class="card-img h-100 scale" alt="card image">';
            } else {
                $html .= '<img src="' . asset("img/default-agenda.webp") . '" class="card-img h-100 scale" alt="default image">';
            }
            $html .= '<div class="card-img-overlay d-flex flex-column justify-content-between reveal-content">';
            $html .= '<div class="row g-0"><div class="col-auto pe-3"><i data-acorn-icon="clock" class="text-white me-1" data-acorn-size="15"></i> <span class="align-middle text-white">' . $agenda->waktu_mulai . ' - ' . $agenda->waktu_selesai . ' WIB</span></div>';
            $html .= '<div class="col-auto"><i data-acorn-icon="pin" class="text-white me-1" data-acorn-size="15"></i> <span class="align-middle text-white">' . $agenda->lokasi . '</span></div></div>';
            $html .= '<div class="row g-0"><div class="col pe-2"><a href="' . route('home.agenda.show', $agenda->slug) . '" class="stretched-link">';
            $html .= '<h5 class="heading text-white mb-1">' . $agenda->nama_kegiatan . '</h5></a>';
            $html .= '<div class="d-inline-block"><div class="text-white text-muted">' . \Illuminate\Support\Str::limit($agenda->deskripsi, 50) . '</div></div></div></div></div></div></div>';
        }

        return response()->json(['html' => $html, 'count' => $agendas->count()]);
    }
    // end Route AJAX untuk load more

    public function showArtikel($slug)
    {
        // Ambil artikel berdasarkan slug
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'Published') // Ensure the article is published
            ->firstOrFail();

        return view('home.kampanye.detail-artikel', compact('artikel'));
    }

    public function showAgenda($slug)
    {
        $agenda = Agenda::where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail(); // ambil berdasarkan slug
        return view('home.kampanye.detail-agenda', compact('agenda'));
    }
}
