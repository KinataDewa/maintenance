<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('panel_inspections', function (Blueprint $table) {
            // Hapus semua kolom catatan lama
            $table->dropColumn([
                'catatan_kabel_terkupas',
                'catatan_mcb_rusak',
                'catatan_panel_bersih',
                'catatan_baut_terminal',
                'catatan_grounding',
                'catatan_mcb_normal',
                'catatan_lampu_indikator',
                'catatan_panel_tertutup',
            ]);

            // Tambahkan kolom catatan baru
            $table->text('catatan')->nullable()->after('panel_tertutup');
        });
    }

    public function down()
    {
        Schema::table('panel_inspections', function (Blueprint $table) {
            // Jika rollback, tambahkan kembali kolom lama
            $table->text('catatan_kabel_terkupas')->nullable();
            $table->text('catatan_mcb_rusak')->nullable();
            $table->text('catatan_panel_bersih')->nullable();
            $table->text('catatan_baut_terminal')->nullable();
            $table->text('catatan_grounding')->nullable();
            $table->text('catatan_mcb_normal')->nullable();
            $table->text('catatan_lampu_indikator')->nullable();
            $table->text('catatan_panel_tertutup')->nullable();

            $table->dropColumn('catatan');
        });
    }
};

