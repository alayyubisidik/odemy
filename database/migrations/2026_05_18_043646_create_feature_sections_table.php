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
        Schema::create('feature_sections', function (Blueprint $table) {
            $table->id();

            $table->string('image_one');
            $table->string('title_one');
            $table->string('subtitle_one');

            $table->string('image_two');
            $table->string('title_two');
            $table->string('subtitle_two');

            $table->string('image_three');
            $table->string('title_three');
            $table->string('subtitle_three');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_sections');
    }
};
