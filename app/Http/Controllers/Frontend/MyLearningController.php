<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLesson;
use App\Models\Enrollment;
use App\Models\WatchHistory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MyLearningController extends Controller
{
    function index()
    {
        $enrollments = Enrollment::with('course')->where('user_id', user()->id)->get();
        return view('frontend.student.dashboard.my-learning.index', compact('enrollments'));
    }

    function playerIndex(string $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        if (!Enrollment::where('user_id', user()->id)->where('course_id', $course->id)->where('have_access', 1)->exists()) return abort(404);
        $lessonCount = CourseChapterLesson::where('course_id', $course->id)->count();
        $lastWatchHistory = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id])->orderBy('updated_at', 'desc')->first();
        $wathedLessonIds = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id, 'is_completed' => 1])->pluck('lesson_id')->toArray();

        // dd($course->duration);
        return view('frontend.student.dashboard.my-learning.player', compact('course', 'lastWatchHistory', 'wathedLessonIds', 'lessonCount'));
    }

    function getLessonContent(Request $request)
    {
        $lesson = CourseChapterLesson::where([
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'id' => $request->lesson_id
        ])->first();

        return response()->json($lesson);
    }


    function updateWatchHistory(Request $request)
    {
        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'updated_at' => now()
            ]
        );
    }

    function updateLessonCompletion(Request $request)
    {
        $watchedLesson = WatchHistory::where([
            'user_id' => user()->id,
            'lesson_id' => $request->lesson_id
        ])->first();

        WatchHistory::updateOrCreate(
            [
                'user_id' => user()->id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'is_completed' => ($watchedLesson && $watchedLesson->is_completed == 1) ? 0 : 1,
            ]
        );

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    function getCertificate(Course $course)
    {

        $wathedLessons = WatchHistory::where(['user_id' => user()->id, 'course_id' => $course->id, 'is_completed' => 1])->count();
        $LessonCount = $course->lessons()->count();

        if ($wathedLessons !== $LessonCount) {
            return abort(404);
        }

        $data = [
            'courseTitle' => $course->title,
            'instructorName' => $course->instructor->name,
            'name' => user()->name,
            'date' => now()->format('F d, Y'),
        ];

        $pdf = Pdf::loadView('frontend.student.dashboard.my-learning.certificate', [
            'data' => $data
        ]);

        return $pdf->download('certificate-' . $course->id . '.pdf');
    }
}
