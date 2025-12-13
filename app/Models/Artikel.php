<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{

    protected $table = 'artikels';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'gambar',
        'judul',
        'deskripsi',
        'slug',
        'kategori',
        'status',
        'last_read_at',
    ];

    // Hook otomatis membuat slug saat membuat artikel
    protected static function booted()
    {
        static::creating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });

        static::updating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readers()
    {
        return $this->belongsToMany(User::class, 'artikel_user_reads')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }
}
