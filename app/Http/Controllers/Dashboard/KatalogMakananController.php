<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataMakanan;
use App\Models\PengambilMakanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KatalogMakananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil semua data makanan, urut dari yang terbaru
        $makanan = DataMakanan::orderBy('created_at', 'desc')->take(6)->get();
        $totalMakanan = DataMakanan::count();

        return view('dashboard.katalog-makanan', compact('user', 'makanan', 'totalMakanan'));
    }

    public function filter(Request $request)
    {
        $kategori = $request->kategori;
        $offset   = $request->offset ?? 0;
        $limit    = 6;

        $query = DataMakanan::query();

        if ($kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        $makanan = $query->orderBy('created_at', 'DESC')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($makanan as $data) {
            $html .= view('dashboard.partials.katalog-makanan-card', compact('data'))->render();
        }

        return response()->json([
            'html' => $html,
            'count' => $makanan->count()
        ]);
    }


    public function ambil(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $makanan = DataMakanan::findOrFail($id);

        if ($request->jumlah > $makanan->porsi) {
            return redirect()->back()->with('error', 'Jumlah pengambilan melebihi stok tersedia.');
        }

        // Kurangi stok makanan
        $makanan->porsi -= $request->jumlah;
        $makanan->save();

        // Rekam pengambilan
        PengambilMakanan::create([
            'user_id' => $user->id,
            'data_makanan_id' => $makanan->id,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu',
        ]);


        return redirect()->back()->with('success', 'Pengambilan berhasil dikonfirmasi!');
    }
}
