<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sos_alerts', function (Blueprint $table) {
            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('ambulance_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('eta')->nullable(); // e.g. "10 mins"
        });
    }

    public function down(): void
    {
        Schema::table('sos_alerts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('doctor_id');
            $table->dropConstrainedForeignId('ambulance_id');
            $table->dropColumn('eta');
        });
    }
};
