<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('exhaust_fans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ruangan');
            $table->string('merk');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exhaust_fans');
    }
};
