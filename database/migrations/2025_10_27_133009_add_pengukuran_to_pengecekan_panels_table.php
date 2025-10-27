<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengecekan_panels', function (Blueprint $table) {
            $table->decimal('tegangan', 8, 2)->nullable()->after('pengecekan');
            $table->decimal('arus', 8, 2)->nullable()->after('tegangan');
            $table->decimal('suhu', 8, 2)->nullable()->after('arus');
            $table->decimal('thermal_imaging', 8, 2)->nullable()->after('suhu');
        });
    }

    public function down(): void
    {
        Schema::table('pengecekan_panels', function (Blueprint $table) {
            $table->dropColumn(['tegangan', 'arus', 'suhu', 'thermal_imaging']);
        });
    }
};
