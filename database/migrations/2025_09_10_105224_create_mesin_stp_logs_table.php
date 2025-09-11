<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mesin_stp_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('mesin', ['Mesin STP 1', 'Mesin STP 2']); // pilihan mesin
            $table->string('oli');      // status oli
            $table->string('vanbelt');  // status vanbelt
            $table->float('suhu');      // suhu dalam °C
            $table->enum('suara', ['Halus', 'Bising Ringan', 'Bising Berat']); // kondisi suara
            $table->string('catatan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // otomatis tanggal & jam
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesin_stp_logs');
    }
};

