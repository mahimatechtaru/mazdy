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
        Schema::create('equipment_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigned_equipment_id')->constrained('assigned_equipments')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // malfunction, service_request, pickup
            $table->text('description')->nullable();
            $table->string('status')->default('open'); // open, in_progress, resolved
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_alerts');
    }
};
