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
        Schema::table('data_expired', function (Blueprint $table) {
            // Tambahkan kolom data_makanan_id jika belum ada
            if (!Schema::hasColumn('data_expired', 'data_makanan_id')) {
                $table->unsignedBigInteger('data_makanan_id')->nullable()->after('id');
            }

            // Tambahkan foreign key baru tanpa cascade
            $table->foreign('data_makanan_id')
                ->references('id')
                ->on('data_makanan')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_expired', function (Blueprint $table) {
            $table->dropForeign(['data_makanan_id']);
            $table->dropColumn('data_makanan_id');
        });
    }
};
