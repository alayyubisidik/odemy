<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseChapterLesson;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\Notification;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use FileUploadTrait;

    function index()
    {
        $courses = Course::paginate(20);
        return view('admin.dashboard.course.index', compact('courses'));
    }

    public function updateApproveStatus(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $course->update([
            'is_approved' => $request->status
        ]);

        if ($request->status === 'approved') {

            Notification::create([
                'user_id' => $course->instructor_id,
                'type' => 'instructor_course_approved',
                'title' => 'Course Approved',
                'message' => 'Your course "' . $course->title . '" has been approved.',
                'url' => route('instructor.courses.index'),
                'icon' => 'ti ti-circle-check',
                'color' => 'success',
            ]);
        }

        if ($request->status === 'rejected') {

            Notification::create([
                'user_id' => $course->instructor_id,
                'type' => 'instructor_course_rejected',
                'title' => 'Course Rejected',
                'message' => 'Your course "' . $course->title . '" has been rejected.',
                'url' => route('instructor.courses.index'),
                'icon' => 'ti ti-circle-x',
                'color' => 'danger',
            ]);
        }

        AlertService::updated();

        return back();
    }


    function create()
    {
        $categories = CourseCategory::where('is_active', 1)->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();
        return view('admin.dashboard.course.create', compact('categories', 'languages', 'levels'));
    }

    public function store(Request $request)
    {
        // VALIDASI DASAR
        $request->validate([
            'title'               => 'required|string|max:255',
            'slug'                => 'required|string|max:255|unique:courses,slug',
            'price'               => 'nullable|numeric|min:0',
            'discount'            => 'nullable|numeric|min:0',

            'category_id'         => 'required|exists:course_categories,id',
            'course_level_id'     => 'required|exists:course_levels,id',
            'course_language_id'  => 'required|exists:course_languages,id',

            'capacity'            => 'nullable|integer|min:1',
            'duration'            => 'nullable|integer|min:1',

            'seo_description'     => 'nullable|string',
            'description'         => 'nullable|string',

            'demo_video_storage'  => 'nullable|in:upload,youtube',

            'certificate'         => 'nullable|boolean',
            'qna'                 => 'nullable|boolean',

            'message_for_reviewer' => 'nullable|string',
            'status'              => 'required|in:active,inactive,draft',
            'is_approved'              => 'required|in:pending,approved,rejected',

            'thumbnail'           => 'nullable|image|max:2048',
        ]);

        /**
         * VALIDASI KONDISIONAL DEMO VIDEO
         */
        if ($request->demo_video_storage === 'upload') {

            // Wajib FILE (path dari UniSharp)
            $request->validate([
                'file' => 'required|string|max:255',
            ]);
        } elseif (in_array($request->demo_video_storage, ['youtube'])) {

            // Wajib URL
            $request->validate([
                'url' => 'required|string|max:255',
            ]);
        }

        /**
         * UPLOAD THUMBNAIL
         */
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->uploadFile(
                $request->file('thumbnail'),
                null,
                'course-thumbnail'
            );
        }

        /**
         * DEMO VIDEO SOURCE
         */
        $demoVideoSource = null;

        if ($request->demo_video_storage === 'upload') {

            // dari UniSharp (path file)
            $demoVideoSource = $request->file;
        } else {

            // dari input URL
            $demoVideoSource = $request->url;
        }

        /**
         * SIMPAN COURSE
         */

        $price = str_replace('.', '', $request->price);

        $discount = str_replace('.', '', $request->discount);

        Course::create([
            'instructor_id'      => user()->id,
            'category_id'        => $request->category_id,
            'course_level_id'    => $request->course_level_id,
            'course_language_id' => $request->course_language_id,

            'title'              => $request->title,
            'slug'               => Str::slug($request->slug),
            'seo_description'    => $request->seo_description,
            'description'        => $request->description,

            'thumbnail'          => $thumbnailPath,
            'demo_video_storage' => $request->demo_video_storage,
            'demo_video_source'  => $demoVideoSource,

            'duration'           => $request->duration,
            'capacity'           => $request->capacity,

            'price'              => $price,
            'discount'           => $discount,

            'certificate'        => $request->has('certificate') ? 1 : 0,
            'qna'                => $request->has('qna') ? 1 : 0,

            'message_for_reviewer' => $request->message_for_reviewer,
            'status'               => $request->status,
            'is_approved'               => $request->is_approved,
        ]);

        AlertService::created();

        return redirect()
            ->route('admin.courses.index');
    }

    function edit(Course $course)
    {
        $categories = CourseCategory::where('is_active', 1)->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();
        return view('admin.dashboard.course.edit', compact('course', 'categories', 'course', 'languages', 'levels'));
    }

    public function update(Request $request, Course $course)
    {
        /**
         * VALIDASI DASAR
         */
        $request->validate([
            'title'               => 'required|string|max:255',
            "slug"                  =>     ["required", "string", "max:255", "unique:courses,slug," . $course->id],
            // 'slug'                => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'price'               => 'nullable|numeric|min:0',
            'discount'            => 'nullable|numeric|min:0',

            'category_id'         => 'required|exists:course_categories,id',
            'course_level_id'     => 'required|exists:course_levels,id',
            'course_language_id'  => 'required|exists:course_languages,id',

            'capacity'            => 'nullable|integer|min:1',
            'duration'            => 'nullable|integer|min:1',

            'seo_description'     => 'nullable|string',
            'description'         => 'nullable|string',

            'demo_video_storage'  => 'nullable|in:upload,youtube',

            'certificate'         => 'nullable|boolean',
            'qna'                 => 'nullable|boolean',

            'message_for_reviewer' => 'nullable|string',
            'status'              => 'required|in:active,inactive,draft',

            'thumbnail'           => 'nullable|image|max:2048',
        ]);



        /**
         * VALIDASI KONDISIONAL DEMO VIDEO
         */
        if ($request->demo_video_storage === 'upload') {
            $request->validate([
                'file' => 'required|string|max:255',
            ]);
        } elseif (in_array($request->demo_video_storage, ['youtube'])) {
            $request->validate([
                'url' => 'required|string|max:255',
            ]);
        }


        /**
         * THUMBNAIL
         */
        $thumbnailPath = $course->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->uploadFile(
                $request->file('thumbnail'),
                $course->thumbnail,
                'course-thumbnail'
            );
        }

        /**
         * DEMO VIDEO SOURCE
         */
        $demoVideoSource = $course->demo_video_source;

        if ($request->demo_video_storage === 'upload') {
            $demoVideoSource = $request->file;
        } elseif ($request->demo_video_storage) {
            $demoVideoSource = $request->url;
        }

        // dd($request->all());

        $price = str_replace('.', '', $request->price);

        $discount = str_replace('.', '', $request->discount);


        /**
         * UPDATE COURSE
         */
        $course->update([
            'category_id'        => $request->category_id,
            'course_level_id'    => $request->course_level_id,
            'course_language_id' => $request->course_language_id,

            'title'              => $request->title,
            'slug'               => Str::slug($request->slug),
            'seo_description'    => $request->seo_description,
            'description'        => $request->description,

            'thumbnail'          => $thumbnailPath,
            'demo_video_storage' => $request->demo_video_storage,
            'demo_video_source'  => $demoVideoSource,

            'duration'           => $request->duration,
            'capacity'           => $request->capacity,

            'price'              => $price,
            'discount'           => $discount,

            'certificate'        => $request->has('certificate') ? 1 : 0,
            'qna'                => $request->has('qna') ? 1 : 0,

            'message_for_reviewer' => $request->message_for_reviewer,
            'status'               => $request->status,
        ]);

        AlertService::updated();

        return redirect()
            ->route('admin.courses.index');
    }

    function destroy(Course $course) {}

    function chapterIndex(Course $course)
    {
        $chapters = CourseChapter::where('course_id', $course->id)->get();

        // dd($chapters);
        return view('admin.dashboard.course.course-content.chapter.index', compact('course', 'chapters'));
    }

    function chapterCreate(Course $course)
    {
        // dd($chapters);
        return view('admin.dashboard.course.course-content.chapter.create', compact('course'));
    }

    function chapterStore(Request $request, Course $course)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'is_active'              => 'nullable|boolean',
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $course->id;
        $chapter->instructor_id = user()->id;
        $chapter->order = CourseChapter::where('course_id', $course->id)->count() + 1;
        $chapter->is_active = $request->has('is_active') ? 1 : 0;
        $chapter->save();

        AlertService::created();

        return to_route('admin.courses.chapters.index', $course->id);
    }

    function chapterEdit(Course $course, CourseChapter $chapter)
    {
        // dd($chapter);
        return view('admin.dashboard.course.course-content.chapter.edit', compact('course', 'chapter'));
    }

    function chapterUpdate(Request $request, Course $course, CourseChapter $chapter)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'is_active'              => 'nullable|boolean',
        ]);

        $chapter->title = $request->title;
        $chapter->is_active = $request->has('is_active') ? 1 : 0;
        $chapter->save();

        AlertService::updated();

        return to_route('admin.courses.chapters.index', $course->id);
    }

    function chapterDestroy(Course $course, CourseChapter $chapter)
    {
        $chapterDelete = CourseChapter::where('id', $chapter->id)->where('instructor_id', user()->id)->where('course_id', $course->id);

        if (!$chapterDelete) {
            AlertService::error('Chapter not found');
            return back();
        }

        $chapterDelete->delete();

        AlertService::deleted();

        return back();
    }

    function lessonIndex(Course $course, CourseChapter $chapter)
    {
        $lessons = CourseChapterLesson::where('course_id', $course->id)->where('chapter_id', $chapter->id)->get();

        // dd($lessons);
        return view('admin.dashboard.course.course-content.lesson.index', compact('course', 'chapter', 'lessons'));
    }

    function lessonCreate(Course $course, CourseChapter $chapter)
    {
        // dd($chapters);
        return view('admin.dashboard.course.course-content.lesson.create', compact('course', 'chapter'));
    }

    public function lessonStore(Request $request, Course $course, CourseChapter $chapter)
    {
        // ================= BASE VALIDATION =================
        $request->validate([
            'title'       => 'required|string|max:255',
            'storage'     => 'required|in:upload,youtube',
            'file_type'   => 'required|in:video,audio,doc,file,pdf',
            'duration'    => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
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
            'course_id'     => $course->id,
            'chapter_id'    => $chapter->id,

            'file_path'     => $filePath,
            'storage'       => $request->storage,
            'file_type'     => $request->file_type,
            'duration'      => $request->duration,
            'volume'        => null,

            'downloadable'  => $request->has('downloadable') ? 1 : 0,
            'is_preview'    => $request->has('is_preview') ? 1 : 0,
            'is_active'    => $request->has('is_active') ? 1 : 0,
            'lesson_type'   => 'lesson',

            'order' => CourseChapterLesson::where('chapter_id', $chapter->id)
                ->max('order') + 1,

        ]);

        AlertService::created();

        return to_route('admin.courses.lessons.index', [$course, $chapter]);
    }

    function lessonDestroy(Course $course, CourseChapter $chapter, CourseChapterLesson $lesson)
    {
        // dd($course->id, $chapter->id, $lesson->id);
        $lessonDelete = CourseChapterLesson::where('id', $lesson->id)->where('instructor_id', user()->id)->where('course_id', $course->id)->where('chapter_id', $chapter->id);

        if (!$lessonDelete) {
            AlertService::error('Lesson not found');
            return back();
        }

        $lessonDelete->delete();

        AlertService::deleted();

        return back();
    }

    function lessonEdit(Course $course, CourseChapter $chapter, CourseChapterLesson $lesson)
    {
        return view('admin.dashboard.course.course-content.lesson.edit', compact('chapter', 'course', 'lesson'));
    }

    public function lessonUpdate(Request $request, Course $course, CourseChapter $chapter, CourseChapterLesson $lesson)
    {
        // VALIDASI
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'storage'     => ['required', 'in:upload,youtube'],
            'file_type'   => ['required', 'in:video,audio,doc,file,pdf'],
            'duration'    => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
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
            'file_type'    => $request->file_type,
            'duration'     => $request->duration,
            'is_preview'   => $request->has('is_preview') ? 1 : 0,
            'downloadable' => $request->has('downloadable') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        AlertService::updated();

        return to_route('admin.courses.lessons.index', [$course, $chapter]);
    }
}
