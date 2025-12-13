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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('gambar')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->enum('status', ['Published', 'Draft'])->default('Draft');
            $table->string('slug')->unique();
            $table->timestamp('last_read_at')->nullable()->comment('Waktu terakhir artikel dibaca oleh user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
