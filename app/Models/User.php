<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'alamat',
        'iframe_maps',
        'organisasi',
        'password',
        'gambar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator untuk password agar otomatis di-hash
     */
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Accessor untuk gambar
     */
    public function getGambarAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('storage/default.png');
    }

    public function daurUlangs()
    {
        return $this->hasMany(DataDaurUlang::class);
    }

    public function daurMakanans()
    {
        return $this->hasMany(DataMakanan::class);
    }
    public function artikelReads()
    {
        return $this->belongsToMany(Artikel::class, 'artikel_user_reads')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }
}
