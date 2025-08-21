<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('log_pembersihan_panel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panel_id')->constrained('panels')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Checklist sederhana (4 poin)
            $table->boolean('debu_bersih')->default(false);
            $table->boolean('luar_bersih')->default(false);
            $table->boolean('dalam_rapi')->default(false);
            $table->boolean('tidak_ada_sampah')->default(false);

            $table->text('catatan')->nullable();

            // Foto sebelum & sesudah
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();

            // Waktu input (simpen terpisah tanggal & jam sesuai request)
            $table->date('tanggal');
            $table->time('jam');

            $table->timestamps();

            // Opsional: batasi 1 log per panel per hari
            // $table->unique(['panel_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pembersihan_panel');
    }
};
