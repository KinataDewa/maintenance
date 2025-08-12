<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('lantaiTenant')->nullable()->after('nama');
            $table->string('ruanganTenant')->nullable()->after('lantaiTenant');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['lantaiTenant', 'ruanganTenant']);
        });
    }
};
