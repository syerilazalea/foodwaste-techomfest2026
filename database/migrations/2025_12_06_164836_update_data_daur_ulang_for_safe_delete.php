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
        Schema::table('data_daur_ulang', function (Blueprint $table) {
            // Hapus FK lama jika ada (sesuaikan nama FK)
            $table->dropForeign(['data_makanan_id']);
            // Ubah kolom menjadi unsignedBigInteger nullable
            $table->unsignedBigInteger('data_makanan_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_daur_ulang', function (Blueprint $table) {
            // Kembalikan FK
            $table->foreign('data_makanan_id')
                ->references('id')
                ->on('data_makanan')
                ->onDelete('set null');
        });
    }
};
