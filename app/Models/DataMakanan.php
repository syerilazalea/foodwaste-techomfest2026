<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMakanan extends Model
{
    use HasFactory;

    protected $table = 'data_makanan';

    protected $fillable = [
        'nama',
        'penyedia',
        'kategori',
        'alamat',
        'porsi',
        'batas_waktu',
        'gambar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengambilanMakanan()
    {
        return $this->hasMany(PengambilMakanan::class, 'data_makanan_id');
    }

    public function getGambarAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('storage/default.png');
    }
}