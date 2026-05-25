<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('type', [

                // =========================
                // ADMIN
                // =========================
                'admin_new_course_submitted',
                'admin_course_waiting_approval',
                'admin_pending_instructor_request',
                'admin_instructor_payout_request',

                // =========================
                // INSTRUCTOR
                // =========================
                'instructor_new_enrollment',
                'instructor_new_course_purchase',
                'instructor_new_review_received',
                'instructor_new_rating_received',
                'instructor_course_approved',
                'instructor_course_rejected',
                'instructor_monthly_earning_summary',
                'instructor_admin_announcement',
                'instructor_payout_approved',
                'instructor_payout_rejected',

                // =========================
                // STUDENT
                // =========================
                'student_enrollment_successful',
                'student_payment_successful',
                'student_certificate_available',
                'student_course_completed',
                'student_learning_reminder',
                'student_instructor_announcement',

            ]);

            $table->string('title');

            $table->text('message');

            $table->string('url')->nullable();

            $table->timestamp('read_at')->nullable();

            $table->string('icon')->nullable();

            $table->string('color')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
