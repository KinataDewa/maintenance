<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengecekan_pompas', function (Blueprint $table) {
            $table->decimal('suhu', 5, 2)->nullable()->after('pompa_unit_id'); // suhu dalam Celsius
            $table->decimal('tekanan', 8, 2)->nullable()->after('suhu'); // tekanan dalam Bar atau PSI
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengecekan_pompas', function (Blueprint $table) {
            $table->dropColumn(['suhu', 'tekanan']);
        });
    }
};
