<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Relasi utama
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('course_level_id')->nullable();
            $table->foreignId('course_language_id')->nullable();

            // Informasi dasar course
            $table->string('title');
            $table->string('slug');
            $table->string('seo_description')->nullable();
            $table->text('description')->nullable();

            // Media & konten
            $table->string('thumbnail')->nullable();
            $table->enum('demo_video_storage', ['upload', 'youtube'])->nullable();
            $table->text('demo_video_source')->nullable();

            // Informasi kelas
            $table->integer('duration')->nullable();

            // Harga
            $table->double('price')->nullable();
            $table->double('discount')->nullable();

            // Review & moderasi
            $table->enum('is_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
