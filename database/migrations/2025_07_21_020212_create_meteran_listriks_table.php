<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('meteran_listriks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ⬅️ tambahkan ini
        $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
        $table->integer('kwh');
        $table->string('foto')->nullable();
        $table->text('deskripsi')->nullable();
        $table->timestamp('waktu_input')->useCurrent();
        $table->timestamps();
    });
}


    public function down(): void {
        Schema::dropIfExists('meteran_listriks');
    }
};
