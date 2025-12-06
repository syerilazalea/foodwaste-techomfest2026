<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilDaurUlang extends Model
{
    protected $table = 'pengambilan_daur_ulang';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'data_daur_ulang_id',
        'jumlah',
        'status',
    ];

    public function daurUlang()
    {
        return $this->belongsTo(DataDaurUlang::class, 'data_daur_ulang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dataDaurUlang()
    {
        return $this->belongsTo(\App\Models\DataDaurUlang::class, 'data_daur_ulang_id');
    }
}
