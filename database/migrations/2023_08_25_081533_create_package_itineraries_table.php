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
        Schema::create('package_itineraries', function (Blueprint $table) {
            $table->snowflakeIdAndPrimary();
            $table->string('name');
            $table->foreignId('package_tour_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('meal')->nullable();
            $table->string('accommodation')->nullable();
            $table->text('note')->nullable();
            $table->string('package_itinerary_photo')->nullable();
            $table->auditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_itineraries');
    }
};