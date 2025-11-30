<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDaurUlang extends Model
{
    use HasFactory;

    protected $table = 'data_daur_ulang';

    protected $fillable = [
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
}
