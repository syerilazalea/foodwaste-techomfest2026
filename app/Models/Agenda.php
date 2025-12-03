<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agenda extends Model
{

    protected $table = 'agenda';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'slug',
        'deskripsi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'kuota',
        'status',
        'gambar',
    ];

    // Otomatis buat slug saat membuat agenda
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agenda) {
            $agenda->slug = Str::slug($agenda->nama_kegiatan);
        });

        static::updating(function ($agenda) {
            $agenda->slug = Str::slug($agenda->nama_kegiatan);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
