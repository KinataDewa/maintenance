<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTemperatureLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('room_temperature_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('titik_1')->nullable();
            $table->float('titik_2')->nullable();
            $table->float('titik_3')->nullable();
            $table->string('foto')->nullable();
            $table->timestamp('waktu_cek')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_temperature_logs');
    }
}
