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
        Schema::create('tours', function (Blueprint $table) {
            $table->snowflakeIdAndPrimary();
            $table->string('name');
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('package_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('overview')->nullable();
            $table->string('price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('location')->nullable();
            $table->string('departure')->nullable();
            $table->string('theme')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->string('type')->nullable();
            $table->string('style')->nullable();
            $table->string('for_whom')->nullable();
            $table->json('tour_photo')->nullable();
            $table->auditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
