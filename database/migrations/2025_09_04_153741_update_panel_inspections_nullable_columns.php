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
        Schema::table('panel_inspections', function (Blueprint $table) {
            $table->boolean('kabel_terkupas')->nullable()->change();
            $table->boolean('mcb_rusak')->nullable()->change();
            $table->boolean('panel_bersih')->nullable()->change();
            $table->boolean('baut_terminal')->nullable()->change();
            $table->boolean('grounding_baik')->nullable()->change();
            $table->boolean('mcb_normal')->nullable()->change();
            $table->boolean('lampu_indikator')->nullable()->change();
            $table->boolean('panel_tertutup')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('panel_inspections', function (Blueprint $table) {
            $table->boolean('kabel_terkupas')->nullable(false)->change();
            $table->boolean('mcb_rusak')->nullable(false)->change();
            $table->boolean('panel_bersih')->nullable(false)->change();
            $table->boolean('baut_terminal')->nullable(false)->change();
            $table->boolean('grounding_baik')->nullable(false)->change();
            $table->boolean('mcb_normal')->nullable(false)->change();
            $table->boolean('lampu_indikator')->nullable(false)->change();
            $table->boolean('panel_tertutup')->nullable(false)->change();
        });
    }
};
