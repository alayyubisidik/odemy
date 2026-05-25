<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLesson;
use App\Models\Enrollment;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\WatchHistory;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentDashboardController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $userId = user()->id;

        $enrolledCourses = Enrollment::where('user_id', $userId)
            ->count();

        $courseProgress = Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')

            ->leftJoin('course_chapter_lessons', function ($join) {

                $join->on('courses.id', '=', 'course_chapter_lessons.course_id')
                    ->where('course_chapter_lessons.is_active', 1);
            })

            ->leftJoin('watch_histories', function ($join) use ($userId) {

                $join->on('course_chapter_lessons.id', '=', 'watch_histories.lesson_id')
                    ->where('watch_histories.user_id', $userId)
                    ->where('watch_histories.is_completed', 1);
            })

            ->where('enrollments.user_id', $userId)

            ->select(
                'courses.id',
                DB::raw('COUNT(DISTINCT course_chapter_lessons.id) as total_lessons'),
                DB::raw('COUNT(DISTINCT watch_histories.lesson_id) as completed_lessons')
            )

            ->groupBy('courses.id')

            ->get();

        $completedCourses = $courseProgress
            ->filter(function ($course) {

                return $course->total_lessons > 0
                    && $course->completed_lessons >= $course->total_lessons;
            })
            ->count();

        $inProgressCourses = $courseProgress
            ->filter(function ($course) {

                return $course->completed_lessons > 0
                    && $course->completed_lessons < $course->total_lessons;
            })
            ->count();

        $totalLearningHours = CourseChapterLesson::join(
            'watch_histories',
            'course_chapter_lessons.id',
            '=',
            'watch_histories.lesson_id'
        )

            ->where('watch_histories.user_id', $userId)
            ->where('watch_histories.is_completed', 1)

            ->get()

            ->sum(function ($lesson) {

                return (int) $lesson->duration;
            });

        $completedCourseProgress = Course::join('course_chapter_lessons', 'courses.id', '=', 'course_chapter_lessons.course_id')

            ->leftJoin('watch_histories', function ($join) use ($userId) {

                $join->on('course_chapter_lessons.id', '=', 'watch_histories.lesson_id')
                    ->where('watch_histories.user_id', $userId);
            })

            ->join('enrollments', 'courses.id', '=', 'enrollments.course_id')

            ->where('enrollments.user_id', $userId)

            ->select(
                'courses.id',
                'courses.title',
                DB::raw('COUNT(DISTINCT course_chapter_lessons.id) as total_lessons'),
                DB::raw('COUNT(DISTINCT CASE WHEN watch_histories.is_completed = 1 THEN watch_histories.lesson_id END) as completed_lessons')
            )

            ->groupBy(
                'courses.id',
                'courses.title'
            )

            ->get()

            ->map(function ($course) {

                $course->progress = $course->total_lessons > 0
                    ? round(($course->completed_lessons / $course->total_lessons) * 100)
                    : 0;

                return $course;
            })

            ->take(4);

        $recentPurchases = OrderItem::with([
            'course',
            'order'
        ])

            ->whereHas('order', function ($query) use ($userId) {

                $query->where('buyer_id', $userId);
            })

            ->latest()

            ->take(5)

            ->get();

        return view('frontend.student.dashboard.main.index', compact(
            'enrolledCourses',
            'completedCourses',
            'inProgressCourses',
            'totalLearningHours',
            'completedCourseProgress',
            'recentPurchases'
        ));
    }
    function becomeInstructor()
    {
        return view('frontend.student.dashboard.become-instructor.index');
    }

    function becomeInstructorStore(Request $request)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12000']
        ]);

        $filePath = $this->uploadPrivateFile($request->file('document'));

        $user = user();

        /** @var \App\Models\User $user */
        $user->update([
            'approve_status' => 'pending',
            'role' => 'instructor',
            'document' => $filePath
        ]);

        AlertService::created('Instructor Request Submitted Successfully');

        return redirect()->route('instructor.dashboard.index');
    }

    function switchToInstructor()
    {
        $user = user();
        $user->role = 'instructor';
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('instructor.dashboard.index');
    }

    function profile()
    {
        $user = user();
        return view('frontend.student.dashboard.profile.index', compact('user'));
    }

    function profileEdit()
    {
        return view('frontend.student.dashboard.profile.edit');
    }

    function profileUpdate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'bio' => 'nullable|string|max:1000',
            "image" => ["nullable", "image", "max:2048"],
            // Contoh social media links, jika ada
            'facebook' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'x' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Ambil user yang sedang login
        $user = user();

        if ($request->hasFile("image")) {
            $validated['image'] = $this->uploadFile($request->file("image"), $user->image, "user-images");
        }

        // Update data user
        /** @var \App\Models\User $user */
        $user->update($validated);

        AlertService::updated("Profile Updated Successfully");

        return back();
    }

    function passwordUpdate(Request $request)
    {
        $user = user();

        // Validasi
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:3|confirmed', // harus ada password_confirmation
        ]);

        // Update email
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        /** @var \App\Models\User $user */
        $user->save();

        // Notifikasi sukses
        AlertService::updated("Password or Email Updated Successfully");

        return back();
    }

    function reviews()
    {
        $reviews = Review::where('user_id', user()->id)->with('course')->latest()->get();
        return view('frontend.student.dashboard.review.index', compact('reviews'));
    }

    function reviewDelete(int $id)
    {
        $review = Review::find($id);
        $review->delete();

        AlertService::deleted("Review Deleted Successfully");

        return back();
    }
}
