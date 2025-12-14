<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class DataDaurUlang extends Model
{
    use HasFactory;

    protected $table = 'data_daur_ulang';

    protected $fillable = [
        'data_makanan_id',
        'nama',
        'penyedia',
        'kategori',
        'alamat',
        'berat',
        'batas_waktu',
        'gambar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pengambilanDaurUlang()
    {
        return $this->hasMany(PengambilDaurUlang::class, 'data_daur_ulang_id');
    }

    public function dataMakanan()
    {
        return $this->hasMany(DataMakanan::class, 'data_makanan_id');
    }

    protected static function booted()
    {
        static::deleting(function ($item) {
            if ($item->gambar && File::exists(public_path($item->gambar))) {
                File::delete(public_path($item->gambar));
            }
        });
    }
}
