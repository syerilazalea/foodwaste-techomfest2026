<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataExpired extends Model
{
    use HasFactory;

    protected $table = 'data_expired';

    protected $fillable = [
        'user_id',
        'data_makanan_id',
        'expired_at',
    ];

    public function makanan()
    {
        return $this->belongsTo(DataMakanan::class, 'data_makanan_id');
    }
}
