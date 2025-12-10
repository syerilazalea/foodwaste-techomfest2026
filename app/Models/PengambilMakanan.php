<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilMakanan extends Model
{

    protected $table = 'pengambilan_makanan';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'data_makanan_id',
        'jumlah',
        'status',
    ];

    public function makanan()
    {
        return $this->belongsTo(DataMakanan::class, 'data_makanan_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dataMakanan()
    {
        return $this->belongsTo(\App\Models\DataMakanan::class, 'data_makanan_id');
    }
}
