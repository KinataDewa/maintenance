<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('meteran_listrik_pln', function (Blueprint $table) {
            $table->id();
            $table->float('kwh');
            $table->float('kvar');
            $table->float('cos_v');
            $table->string('foto');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->time('jam');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meteran_listrik_pln');
    }
};
