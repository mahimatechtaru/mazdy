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
        Schema::create('technician_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_id')->constrained('equipment_alerts')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('vendors')->onDelete('cascade');
            $table->string('status')->default('scheduled'); // scheduled, completed
            $table->dateTime('visit_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_assignments');
    }
};
