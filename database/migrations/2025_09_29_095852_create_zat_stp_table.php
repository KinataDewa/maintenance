<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zat_stp', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // otomatis diisi saat input
            $table->string('cek_ph_nilai')->nullable();
            $table->string('cek_ph_foto')->nullable();
            $table->string('klorin_nilai')->nullable();
            $table->string('klorin_foto')->nullable();
            $table->string('bakteri_nilai')->nullable();
            $table->string('bakteri_foto')->nullable();
            $table->string('lumpur_nilai')->nullable();
            $table->string('lumpur_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zat_stp');
    }
};
