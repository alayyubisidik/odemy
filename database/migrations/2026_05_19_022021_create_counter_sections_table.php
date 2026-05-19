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
        Schema::create('counter_sections', function (Blueprint $table) {
            $table->id();
            $table->string('counter_one')->default(0);
            $table->string('title_one')->nullable();

            $table->string('counter_two')->default(0);
            $table->string('title_two')->nullable();

            $table->string('counter_three')->default(0);
            $table->string('title_three')->nullable();

            $table->string('counter_four')->default(0);
            $table->string('title_four')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counter_sections');
    }
};
