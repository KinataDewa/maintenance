<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('checklists', function (Blueprint $table) {
        $table->id();
        $table->string('aktivitas');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->string('status')->default('belum');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
