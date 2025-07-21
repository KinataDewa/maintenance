<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('meteran_listriks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->integer('kwh');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamp('waktu_input')->useCurrent(); // waktu dari server
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('meteran_listriks');
    }
};
