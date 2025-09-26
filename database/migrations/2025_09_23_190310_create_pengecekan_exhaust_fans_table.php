<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengecekan_exhaust_fans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exhaust_fan_id')->constrained('exhaust_fans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('pengecekan')->nullable();
            $table->json('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengecekan_exhaust_fans');
    }
};
