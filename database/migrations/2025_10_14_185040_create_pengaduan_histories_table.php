<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduan')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status_lama')->nullable();
            $table->string('status_baru')->nullable();
            $table->text('progres_lama')->nullable();
            $table->text('progres_baru')->nullable();
            $table->timestamps(); // created_at = waktu perubahan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_histories');
    }
};
