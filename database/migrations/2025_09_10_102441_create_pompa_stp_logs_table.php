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
        Schema::create('pompa_stp_logs', function (Blueprint $table) {
            $table->id();

            // Pilihan Pompa STP 1 atau 2
            $table->enum('pompa', ['Pompa STP 1', 'Pompa STP 2']);

            // Input teknis
            $table->float('voltase')->nullable(); // Voltase (V)
            $table->float('suhu')->nullable();    // Suhu (°C)

            // Kondisi komponen
            $table->enum('oli', ['Normal', 'Kurang', 'Kotor'])->nullable();
            $table->enum('pulling', ['Baik', 'Perlu Dicek', 'Rusak'])->nullable();
            $table->enum('motor', ['Normal', 'Overheat', 'Bergetar', 'Tidak Berfungsi'])->nullable();

            // User yang mengisi
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Waktu pengisian
            $table->timestamps(); // created_at = tanggal & jam otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_stp_logs');
    }
};
