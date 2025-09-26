<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perawatan_exhaust_fans', function (Blueprint $table) {
            $table->decimal('daya_hisap', 8, 2)->nullable()->after('exhaust_fan_id');
            $table->decimal('suhu', 5, 2)->nullable()->after('daya_hisap');
        });
    }

    public function down(): void
    {
        Schema::table('perawatan_exhaust_fans', function (Blueprint $table) {
            $table->dropColumn(['daya_hisap', 'suhu']);
        });
    }
};
