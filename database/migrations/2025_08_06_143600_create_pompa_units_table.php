<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pompa_units', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pompa');
        $table->string('merk')->nullable();
        $table->string('tipe')->nullable();
        $table->string('kapasitas')->nullable();
        $table->string('tekanan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_units');
    }
};
