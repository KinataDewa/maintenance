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
        Schema::create('acs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');      // Nama AC
            $table->string('ruangan');   // Lokasi AC
            $table->string('nomor')->unique(); // Nomor inventaris / kode AC
            $table->string('merk');      // Merk AC
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acs');
    }
};
