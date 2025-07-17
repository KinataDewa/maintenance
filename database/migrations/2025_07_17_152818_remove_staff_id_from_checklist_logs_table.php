<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('checklist_logs', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['staff_id']);

            // Baru drop kolomnya
            $table->dropColumn('staff_id');
        });
    }

    public function down()
    {
        Schema::table('checklist_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id');

            // Jika ingin tambahkan kembali FK, sesuaikan nama tabel
            $table->foreign('staff_id')->references('id')->on('staff');
        });
    }
};
