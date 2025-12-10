<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataDaurUlang;
use App\Models\PengambilDaurUlang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogDaurUlangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil semua data makanan, urut dari yang terbaru
        $daurUlang = DataDaurUlang::orderBy('created_at', 'desc')->take(6)->get();
        $totalDaurUlang = DataDaurUlang::count();

        return view('dashboard.katalog-daur-ulang', compact('user', 'daurUlang', 'totalDaurUlang'));
    }

    public function filter(Request $request)
    {
        $kategori = $request->kategori;
        $offset   = $request->offset ?? 0;
        $limit    = 6;

        $query = DataDaurUlang::query();

        if ($kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        $daurUlang = $query->orderBy('created_at', 'DESC')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($daurUlang as $data) {
            $html .= view('dashboard.partials.katalog-daurUlang-card', compact('data'))->render();
        }

        return response()->json([
            'html' => $html,
            'count' => $daurUlang->count()
        ]);
    }

    public function ambil(Request $request, $id)
    {
        // ubah koma menjadi titik
        $request->merge([
            'jumlah' => str_replace(',', '.', $request->jumlah)
        ]);

        $request->validate([
            'jumlah' => 'required|numeric|min:0.1',
        ]);

        $user = Auth::user();

        $daurUlang = DataDaurUlang::findOrFail($id);

        if ($request->jumlah > $daurUlang->berat) {
            return redirect()->back()->with('error', 'Jumlah pengambilan melebihi stok tersedia.');
        }

        // Kurangi stok makanan
        $daurUlang->berat -= $request->jumlah;
        $daurUlang->save();

        // Rekam pengambilan
        PengambilDaurUlang::create([
            'user_id' => $user->id,
            'data_daur_ulang_id' => $daurUlang->id,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu',
        ]);


        return redirect()->back()->with('success', 'Pengambilan berhasil dikonfirmasi!');
    }
}
