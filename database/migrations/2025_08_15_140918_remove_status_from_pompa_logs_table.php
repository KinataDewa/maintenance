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
    Schema::table('pompa_logs', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

public function down()
{
    Schema::table('pompa_logs', function (Blueprint $table) {
        $table->enum('status', ['Baik', 'Perbaikan', 'Rusak'])->nullable();
    });
}

};
