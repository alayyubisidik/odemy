<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\CourseChapterLesson;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    function createChapter()
    {
        return view('frontend.instructor.dashboard.course.partials.create-chapter-modal')->render();
    }

    function storeChapter(Request $request)
    {
        $request->validate([
            'chapter_title' => ['required', 'max:255'],
        ]);

        $course = Course::find(session('course_id'));

        $chapter = new CourseChapter();
        $chapter->title = $request->chapter_title;
        $chapter->course_id = $course->id;
        $chapter->instructor_id = user()->id;
        $chapter->save();

        AlertService::created();

        return redirect()->back();
    }

    function updateChapter(Request $request)
    {
        $request->validate([
            'chapter_id'   => ['required', 'exists:course_chapters,id'],
            'title'       => ['required', 'string', 'max:255'],
        ]);

        $chapter = CourseChapter::find($request->chapter_id);

        $chapter->update([
            'title' => $request->title
        ]);

        AlertService::updated();

        return back();
    }

    public function destroyChapter(CourseChapter $chapter)
    {
        $chapter->delete();
        AlertService::deleted();

        return back();
    }


    function createLesson()
    {
        return view('frontend.instructor.dashboard.course.partials.create-lesson-modal')->render();
    }

    public function storeLesson(Request $request)
    {
        // ================= BASE VALIDATION =================
        $request->validate([
            'chapter_id'  => 'required|exists:course_chapters,id',
            'title'       => 'required|string|max:255',
            'storage'     => 'required|in:upload,youtube,vimeo,external_link',
            'duration'    => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        // ================= CONDITIONAL VALIDATION =================
        if ($request->storage === 'upload') {
            $request->validate([
                'file' => 'required|string',
            ]);
        } else {
            $request->validate([
                'url' => 'required|string',
            ]);
        }

        // ================= COURSE ID FROM SESSION =================
        $courseId = Session::get('course_id');

        // ================= FILE PATH =================
        $filePath = $request->storage === 'upload'
            ? $request->file
            : $request->url;

        // ================= SAVE =================
        CourseChapterLesson::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,

            'instructor_id' => user()->id,
            'course_id'     => $courseId,
            'chapter_id'    => $request->chapter_id,

            'file_path'     => $filePath,
            'storage'       => $request->storage,
            'duration'      => $request->duration,

            'is_preview'    => $request->has('is_preview') ? 1 : 0,
            'is_active'     => true,
        ]);

        AlertService::created();

        return back();
    }

    public function updateLesson(Request $request)
    {
        // VALIDASI
        $request->validate([
            'lesson_id'   => ['required', 'exists:course_chapter_lessons,id'],
            'title'       => ['required', 'string', 'max:255'],
            'storage'     => ['required', 'in:upload,youtube,vimeo,external_link'],
            'duration'    => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_preview' => ['nullable', 'boolean'],
        ]);

        // ================= CONDITIONAL VALIDATION =================
        if ($request->storage === 'upload') {
            $request->validate([
                'file' => 'required|string',
            ]);
        } else {
            $request->validate([
                'url' => 'required|string',
            ]);
        }

        // AMBIL LESSON
        $lesson = CourseChapterLesson::findOrFail($request->lesson_id);

        // TENTUKAN FILE PATH
        $filePath = null;

        if ($request->storage === 'upload') {
            $filePath = $request->file; // dari filemanager
        } else {
            $filePath = $request->url;
        }

        // UPDATE DATA
        $lesson->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'description'  => $request->description,
            'storage'      => $request->storage,
            'file_path'    => $filePath,
            'duration'     => $request->duration,
            'is_preview'   => $request->has('is_preview') ? 1 : 0,
        ]);

        AlertService::updated();

        return back();
    }

    public function destroyLesson(CourseChapterLesson $lesson)
    {
        $lesson->delete();
        AlertService::deleted();

        return back();
    }

    /** Sort chapter lessons */

}
