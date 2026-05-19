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
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            $table->string('icon_one')->nullable();
            $table->string('title_one');
            $table->string('subtitle_one');

            $table->string('icon_two')->nullable();
            $table->string('title_two');
            $table->string('subtitle_two');

            $table->string('icon_three')->nullable();
            $table->string('title_three');
            $table->string('subtitle_three');

            $table->string('icon_four')->nullable();
            $table->string('title_four');
            $table->string('subtitle_four');

            $table->string('image')->nullable();
            $table->text('map_link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
