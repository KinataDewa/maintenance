<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhaustFanLogsTable extends Migration
{
    public function up()
    {
        Schema::create('exhaust_fan_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exhaust_fan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['normal', 'tidak normal']);
            $table->string('perawatan')->default('pembersihan');
            $table->string('foto_pembersihan')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->time('jam');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exhaust_fan_logs');
    }
}
