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
        Schema::create('panel_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panel_id')->constrained('panels')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Inspeksi Visual
            $table->boolean('kabel_terkupas')->default(false);
            $table->text('catatan_kabel_terkupas')->nullable();

            $table->boolean('mcb_rusak')->default(false);
            $table->text('catatan_mcb_rusak')->nullable();

            $table->boolean('panel_bersih')->default(false);
            $table->text('catatan_panel_bersih')->nullable();

            // Periksa Sambungan
            $table->boolean('baut_terminal')->default(false);
            $table->text('catatan_baut_terminal')->nullable();

            $table->boolean('grounding_baik')->default(false);
            $table->text('catatan_grounding')->nullable();

            // Suhu
            $table->decimal('suhu_mcb', 5, 2)->nullable();
            $table->decimal('suhu_terminal', 5, 2)->nullable();

            // Fungsi Proteksi
            $table->boolean('mcb_normal')->default(false);
            $table->text('catatan_mcb_normal')->nullable();

            $table->boolean('lampu_indikator')->default(false);
            $table->text('catatan_lampu_indikator')->nullable();

            // Kebersihan & Keamanan
            $table->boolean('panel_tertutup')->default(false);
            $table->text('catatan_panel_tertutup')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_inspections');
    }
};

