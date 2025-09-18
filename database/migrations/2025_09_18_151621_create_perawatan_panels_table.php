<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('perawatan_panels', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel panels
            $table->foreignId('panel_id')->constrained('panels')->onDelete('cascade');

            // Pengecekan panel (JSON untuk simpan checkbox visual, pengujian, lingkungan)
            $table->json('pengecekan')->nullable();

            // Perawatan panel (JSON untuk simpan checkbox pembersihan, pengencangan, dll.)
            $table->json('perawatan')->nullable();

            // Foto dokumentasi
            $table->json('foto')->nullable(); // Bisa lebih dari satu foto

            // Catatan tambahan
            $table->text('catatan')->nullable();

            // User yang melakukan perawatan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Tanggal dan jam otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan_panels');
    }
};
