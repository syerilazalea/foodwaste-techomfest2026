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
        Schema::create('data_makanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama item
            $table->string('penyedia'); // nama penyedia
            $table->enum('kategori', ['UMKM','Restoran','Hotel','Rumah Tangga']); // kategori
            $table->string('alamat'); // alamat penyedia
            $table->integer('porsi'); // jumlah porsi
            $table->time('batas_waktu'); // batas waktu pengambilan
            $table->string('gambar')->nullable(); // path foto
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_makanan');
    }
};
