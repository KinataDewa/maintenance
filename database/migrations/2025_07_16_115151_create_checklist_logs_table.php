<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checklist_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->constrained()->onDelete('cascade'); // aktivitas
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->date('tanggal'); // tanggal pengisian
            $table->enum('status', ['belum', 'progres', 'selesai'])->default('belum');
            $table->timestamps();

            $table->unique(['checklist_id', 'staff_id', 'tanggal']); // hanya 1 kali per hari
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklist_logs');
    }
};

