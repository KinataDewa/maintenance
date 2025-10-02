<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengecekan_ac', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ac_id'); // relasi ke master AC
            $table->unsignedBigInteger('user_id')->nullable(); // staff yang input
            $table->enum('lokasi', ['Indoor', 'Outdoor']); // indoor/outdoor
            $table->json('pengecekan')->nullable(); // checklist pengecekan
            $table->json('foto')->nullable(); // upload foto
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('ac_id')->references('id')->on('acs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengecekan_ac');
    }
};
