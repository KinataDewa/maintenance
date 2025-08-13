<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMeteranListrikInduksTable extends Migration
{
    public function up()
    {
        Schema::table('meteran_listrik_induks', function (Blueprint $table) {
            $table->string('wbp')->nullable()->after('cosphi');
            $table->string('lwbp')->nullable()->after('wbp');
            $table->string('total')->nullable()->after('lwbp');

            $table->string('foto_kwh')->nullable()->after('foto');
            $table->string('foto_cosphi')->nullable()->after('foto_kwh');
            $table->string('foto_kvar')->nullable()->after('foto_cosphi');
            $table->string('foto_wbp')->nullable()->after('foto_kvar');
            $table->string('foto_lwbp')->nullable()->after('foto_wbp');
            $table->string('foto_total')->nullable()->after('foto_lwbp');
        });
    }

    public function down()
    {
        Schema::table('meteran_listrik_induks', function (Blueprint $table) {
            $table->dropColumn([
                'wbp', 'lwbp', 'total',
                'foto_kwh', 'foto_cosphi', 'foto_kvar',
                'foto_wbp', 'foto_lwbp', 'foto_total'
            ]);
        });
    }
}
