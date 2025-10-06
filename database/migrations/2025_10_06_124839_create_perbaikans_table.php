<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_perangkat'); // AC, Exhaust Fan, Panel, dll
            $table->unsignedBigInteger('perangkat_id')->nullable(); // id dari tabel terkait
            $table->string('nama_perangkat'); // nama perangkat (diambil dari tabel perangkat terkait)
            $table->text('jenis_kerusakan')->nullable(); // deskripsi kerusakan
            $table->text('tindakan_perbaikan')->nullable(); // apa yang dilakukan untuk memperbaiki
            $table->text('catatan')->nullable(); // catatan tambahan
            $table->string('foto')->nullable(); // upload foto kondisi
            $table->unsignedBigInteger('user_id')->nullable(); // siapa yang memperbaiki
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
