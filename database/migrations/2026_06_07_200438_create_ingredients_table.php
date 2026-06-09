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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('energy_kcal')->nullable();
            $table->decimal('proteins', 7, 2)->nullable();
            $table->decimal('lipids', 7, 2)->nullable();
            $table->decimal('available_carbohydrates', 7, 2)->nullable();
            $table->decimal('total_fiber', 7, 2)->nullable();
            $table->decimal('iron', 7, 2)->nullable();
            $table->decimal('sodium', 7, 2)->nullable();
            $table->decimal('calcium', 7, 2)->nullable();
            $table->decimal('potassium', 7, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
