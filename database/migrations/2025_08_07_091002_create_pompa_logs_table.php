<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePompaLogsTable extends Migration
{
    public function up()
    {
        Schema::create('pompa_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pompa_unit_id')->constrained()->onDelete('cascade'); // jenis pompa
            $table->enum('status', ['Baik','Perbaikan','Rusak']);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user yang mengisi
            $table->timestamps(); // created_at sebagai waktu input
        });
    }

    public function down()
    {
        Schema::dropIfExists('pompa_logs');
    }
}