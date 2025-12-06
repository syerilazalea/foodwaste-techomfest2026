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
        Schema::create('pengambilan_daur_ulang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user yang mengambil
            $table->foreignId('data_daur_ulang_id')->constrained('data_daur_ulang')->onDelete('cascade'); // makanan yang diambil
            $table->decimal('jumlah', 8, 2); // misal 2.4 kg
            $table->enum('status', ['menunggu', 'perjalanan', 'diambil'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengambilan_daur_ulang');
    }
};
