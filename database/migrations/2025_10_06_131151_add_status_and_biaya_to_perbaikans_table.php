<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perbaikans', function (Blueprint $table) {
            // hapus ->after('tindakan')
            $table->enum('status', ['belum', 'proses', 'sudah'])->default('belum');
            $table->decimal('biaya', 10, 2)->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('perbaikans', function (Blueprint $table) {
            $table->dropColumn(['status', 'biaya']);
        });
    }
};
