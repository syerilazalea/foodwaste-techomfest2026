<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        return view('dashboard.index', compact(
            'user',
            'pesananMakanan',
            'pesananDaurUlang',
            'dipesanMakanan',
            'dipesanDaurUlang'
        ));
    }

    public function mulaiPengambilanMakanan($id)
    {
        $item = \App\Models\PengambilMakanan::findOrFail($id);

        // Hanya jika status saat ini menunggu
        if ($item->status === 'menunggu') {
            $item->status = 'perjalanan'; // ubah status
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


    public function topbar()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        return view('dashboard.layouts.topbar', compact('user'));
    }
}
