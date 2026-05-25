<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE notifications
            MODIFY COLUMN type ENUM(

                'admin_new_course_submitted',
                'admin_course_waiting_approval',
                'admin_instructor_payout_request',

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

                'student_enrollment_successful',
                'student_payment_successful',
                'student_certificate_available',
                'student_course_completed',
                'student_learning_reminder',
                'student_instructor_announcement'

            ) NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE notifications
            MODIFY COLUMN type ENUM(

                'admin_new_course_submitted',
                'admin_course_waiting_approval',

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

                'student_enrollment_successful',
                'student_payment_successful',
                'student_certificate_available',
                'student_course_completed',
                'student_learning_reminder',
                'student_instructor_announcement'

            ) NOT NULL
        ");
    }
};
