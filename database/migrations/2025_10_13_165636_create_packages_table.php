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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('plan_type')->nullable(); // e.g., Daily, Weekly, Monthly, Custom
            $table->decimal('price', 10, 2)->default(0);
            $table->string('duration')->nullable(); // e.g., 7 days, 1 month
            $table->string('badge')->nullable(); // e.g., Most Popular
            $table->string('target_audience')->nullable();
            $table->longText('inclusions')->nullable();
            $table->longText('exclusions')->nullable();
            $table->longText('faqs')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('cancellation_policy')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
