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
        Schema::create('course_chapter_lessons', function (Blueprint $table) {
            // Primary
            $table->id();

            // Basic Information
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();

            // Relation
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('chapter_id')->constrained('course_chapters')->cascadeOnDelete();

            // Media
            $table->text('file_path')->nullable();
            $table->enum('storage', ['upload', 'youtube', 'vimeo', 'external_link']);
            $table->enum('file_type', ['video', 'audio', 'doc', 'file', 'pdf']);
            $table->string('duration')->nullable();
            $table->string('volume')->nullable();

            // Settings
            $table->boolean('downloadable')->default(false);
            $table->boolean('is_preview')->default(false);
            $table->boolean('is_active')->default(true);
            $table->enum('lesson_type', ['lesson', 'live']);

            // Ordering
            $table->integer('order');

            // Timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_chapter_lessons');
    }
};
