<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel pengaduan.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();

            // Jenis kendala / keluhan utama
            $table->string('jenis_kendala');

            // Deskripsi atau penjelasan detail kendala
            $table->text('deskripsi')->nullable();

            // Perangkat yang bermasalah
            $table->string('perangkat_tipe')->nullable(); // Contoh: AC, Panel, PompaUnit
            $table->unsignedBigInteger('perangkat_id')->nullable(); // ID perangkat jika ada
            $table->string('perangkat_lainnya')->nullable(); // Jika user memilih "Lainnya"

            // Lokasi dan penanggung jawab ruangan
            $table->unsignedBigInteger('room_id'); // Relasi ke tabel rooms
            $table->string('pic_nama'); // Nama PIC ruangan
            $table->string('pic_telp'); // Nomor telepon PIC

            // Foto bukti pendukung
            $table->string('foto')->nullable();

            // Status laporan pengaduan
            $table->enum('status', ['baru', 'proses', 'selesai'])->default('baru');

            // Kolom waktu
            $table->timestamps();

            // Relasi ke tabel rooms
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi jika diperlukan.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
