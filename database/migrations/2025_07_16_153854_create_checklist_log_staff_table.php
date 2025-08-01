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
    Schema::create('checklist_log_staff', function (Blueprint $table) {
        $table->id();
        $table->foreignId('checklist_log_id')->constrained('checklist_logs')->onDelete('cascade');
        $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_log_staff');
    }
};
