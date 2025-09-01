<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemakaian_air', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // siapa yang input
            $table->enum('sumber_air', ['PDAM', 'STP']); // pilihan sumber
            $table->string('meteran'); // bisa nanti relasi kalau ada tabel meteran
            $table->string('foto')->nullable(); // path foto
            $table->text('deskripsi')->nullable();
            $table->date('tanggal'); // tanggal input
            $table->time('waktu'); // jam & menit input
            $table->timestamps();

            // relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemakaian_air');
    }
};
