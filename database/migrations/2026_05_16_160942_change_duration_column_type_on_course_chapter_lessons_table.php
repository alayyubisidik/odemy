<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_chapter_lessons', function (Blueprint $table) {
            $table->integer('duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_chapter_lessons', function (Blueprint $table) {
            $table->string('duration')->nullable()->change();
        });
    }
};
