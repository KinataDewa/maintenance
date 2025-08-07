<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('checklist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perangkat_id')->constrained('perangkat')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('aksi', ['on', 'off']);
            $table->date('tanggal'); 
            $table->time('jam');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklist');
    }
};
