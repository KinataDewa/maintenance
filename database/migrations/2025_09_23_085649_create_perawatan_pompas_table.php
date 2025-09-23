<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengecekan_pompas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pompa_unit_id')->constrained()->onDelete('cascade');
            $table->json('pengecekan')->nullable();
            $table->json('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengecekan_pompas');
    }
};
