<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeteranListrikInduksTable extends Migration
{
   public function up(): void
    {
        Schema::create('meteran_listrik_induks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menyimpan siapa yang input
            $table->date('tanggal');
            $table->time('jam');
            $table->float('kwh')->nullable();
            $table->float('kvar')->nullable();
            $table->float('cosphi')->nullable(); // cos φ (power factor)
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meteran_listrik_induks');
    }
}
