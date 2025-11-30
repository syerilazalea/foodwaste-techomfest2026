<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_daur_ulang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('penyedia');
            $table->enum('kategori', ['UMKM', 'Restoran', 'Hotel', 'Rumah Tangga']);
            $table->string('alamat');
            $table->decimal('berat', 8, 2); // misal 2.4 kg
            $table->time('batas_waktu');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_daur_ulang');
    }
};
