<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pengaduan MODIFY status ENUM(
            'Diproses',
            'Proses PO Barang',
            'Proses Order Barang',
            'Proses Barang Diterima',
            'Proses Pengerjaan',
            'Selesai'
        ) NOT NULL DEFAULT 'Diproses'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengaduan MODIFY status ENUM('baru','proses','selesai') NOT NULL DEFAULT 'baru'");
    }
};
