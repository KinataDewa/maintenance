<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pompa_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pompa_unit_id')->constrained('pompa_units')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user yang melakukan perawatan
            $table->float('voltase')->nullable();
            $table->float('suhu')->nullable();
            $table->float('tekanan')->nullable();
            $table->enum('oli', ['bocor', 'tidak'])->nullable();
            $table->enum('suara', ['halus', 'kasar'])->nullable();
            $table->timestamp('tanggal_perawatan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pompa_maintenance');
    }
};
