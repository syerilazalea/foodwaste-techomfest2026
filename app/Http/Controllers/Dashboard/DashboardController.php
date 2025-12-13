<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DataDaurUlang;
use App\Models\DataExpired;
use App\Models\DataMakanan;
use App\Models\PengambilDaurUlang;
use App\Models\PengambilMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pesanan makanan + data makanan + user yang membuat makanan
        $pesananMakanan = \App\Models\PengambilMakanan::with([
            'makanan.user'   // ini mengambil pembuat makanan
        ])
            ->where('user_id', $user->id)
            ->get();

        // Pesanan daur ulang + data daur ulang + user yang membuat daur ulang
        $pesananDaurUlang = \App\Models\PengambilDaurUlang::with([
            'daurUlang.user'  // ini mengambil pembuat daur ulang
        ])
            ->where('user_id', $user->id)
            ->get();

        // Pesanan makanan + data makanan + user yang membuat makanan
        $dipesanMakanan = \App\Models\PengambilMakanan::with(['makanan.user'])
            ->whereHas('makanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        // Pesanan daur ulang + data daur ulang + user yang membuat daur ulang
        $dipesanDaurUlang = \App\Models\PengambilDaurUlang::with(['daurUlang.user'])
            ->whereHas('daurUlang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        // Pesanan makanan + data makanan + user yang membuat makanan
        $diambilMakanan = \App\Models\PengambilMakanan::with(['makanan.user'])
            ->whereHas('makanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        //================= Untuk Pemesan ======================

        // Total pemesanan makanan yang dilakukan user
        $totalMemesanMakanan = PengambilMakanan::where('user_id', $user->id)->count();

        // Total pemesanan daur ulang yang dilakukan user
        $totalMemesanDaurUlang = PengambilDaurUlang::where('user_id', $user->id)->count();

        // Total keseluruhan item dipesan
        $totalMemesan = $totalMemesanMakanan + $totalMemesanDaurUlang;

        // Total PengambilMakanan dengan status menunggu
        $totalDipesanMakananMenunggu = PengambilMakanan::whereIn('status', ['menunggu'])
            ->whereHas('dataMakanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total PengambilDaurUlang dengan status menunggu
        $totalDipesanDaurUlangMenunggu = PengambilDaurUlang::whereIn('status', ['menunggu'])
            ->whereHas('dataDaurUlang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total keseluruhan Status Menunggu
        $totalMemesanMenunggu = $totalDipesanMakananMenunggu + $totalDipesanDaurUlangMenunggu;

        // Total PengambilMakanan dengan status perjalanan
        $totalDipesanMakananPerjalanan = PengambilMakanan::whereIn('status', ['perjalanan'])
            ->whereHas('dataMakanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total PengambilDaurUlang dengan status perjalanan
        $totalDipesanDaurUlangPerjalanan = PengambilDaurUlang::whereIn('status', ['perjalanan'])
            ->whereHas('dataDaurUlang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total keseluruhan
        $totalMemesanPerjalanan = $totalDipesanMakananPerjalanan + $totalDipesanDaurUlangPerjalanan;

        //============== Untuk Dipesan ====================

        // Total PengambilMakanan dengan status menunggu atau perjalanan
        $totalDipesanMakanan = PengambilMakanan::whereIn('status', ['menunggu', 'perjalanan'])
            ->whereHas('dataMakanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total PengambilDaurUlang (misal status menunggu atau sesuai kebutuhan)
        $totalDipesanDaurUlang = PengambilDaurUlang::whereIn('status', ['menunggu', 'perjalanan'])
            ->whereHas('dataDaurUlang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total keseluruhan
        $totalDataMenungguDiambil = $totalDipesanMakanan + $totalDipesanDaurUlang;

        // Total PengambilMakanan dengan status diammbil
        $totalDiambilMakanan = PengambilMakanan::whereIn('status', ['diambil'])
            ->whereHas('dataMakanan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total PengambilDaurUlang (misal status menunggu atau sesuai kebutuhan)
        $totalDiambilDaurUlang = PengambilDaurUlang::whereIn('status', ['diambil'])
            ->whereHas('dataDaurUlang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->count();

        // Total keseluruhan
        $totalDataDiambil = $totalDiambilMakanan + $totalDiambilDaurUlang;

        // Hitung total data disumbangkan milik user
        $totalMakanan = DataMakanan::where('user_id', $user->id)->count();
        $totalDaurUlang = DataDaurUlang::where('user_id', $user->id)->count();
        $totalDisumbangkan = $totalMakanan + $totalDaurUlang;

        // Hitung total data expired milik user
        $totalExpired = DataExpired::where('user_id', $user->id)->count();

        return view('dashboard.index', compact(
            'user',
            'pesananMakanan',
            'pesananDaurUlang',
            'dipesanMakanan',
            'dipesanDaurUlang',
            'diambilMakanan',
            'totalMemesan',
            'totalMemesanMenunggu',
            'totalMemesanPerjalanan',
            'totalDataMenungguDiambil',
            'totalDataDiambil',
            'totalDisumbangkan',
            'totalExpired'
        ));
    }

    public function mulaiPengambilanMakanan($id)
    {
        $item = \App\Models\PengambilMakanan::findOrFail($id);

        // Hanya jika status saat ini menunggu
        if ($item->status === 'menunggu') {
            $item->status = 'perjalanan';
            $item->save();
        }

        return redirect()->back()->with('success', 'Status pengambilan telah diperbarui!');
    }

    public function mulaiPengambilanDaurUlang($id)
    {
        $item = \App\Models\PengambilDaurUlang::findOrFail($id);

        // Hanya jika status saat ini menunggu
        if ($item->status === 'menunggu') {
            $item->status = 'perjalanan'; // ubah status
            $item->save();
        }

        return redirect()->back()->with('success', 'Status pengambilan telah diperbarui!');
    }

    public function makananSudahDiambil($id)
    {
        $item = \App\Models\PengambilMakanan::findOrFail($id);

        // Hanya jika status perjalanan saat ini 
        if ($item->status === 'perjalanan') {
            $item->status = 'diambil';
            $item->save();
        }

        return redirect()->back()->with('success', 'Status pengambilan telah diperbarui!');
    }

    public function daurUlangSudahDiambil($id)
    {
        $item = \App\Models\PengambilDaurUlang::findOrFail($id);

        // Hanya jika status perjalanan saat ini 
        if ($item->status === 'perjalanan') {
            $item->status = 'diambil';  
            $item->save();
        }

        return redirect()->back()->with('success', 'Status pengambilan telah diperbarui!');
    }


    public function topbar()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        return view('dashboard.layouts.topbar', compact('user'));
    }
}
