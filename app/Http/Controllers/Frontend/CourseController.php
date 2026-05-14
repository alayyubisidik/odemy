<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    use FileUploadTrait;

    function index()
    {
        session()->forget('course_id');

        $courses = Course::where('instructor_id', user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.instructor.dashboard.course.index', compact('courses'));
    }

    function create()
    {
        $course = null;

        if (session('course_id')) {
            $course = Course::find(session('course_id'));
        }

        return view('frontend.instructor.dashboard.course.create-course-tab.basic-info', compact('course'));
    }

    function edit(Course $course)
    {
        Session::put('course_id', $course->id);

        return to_route('instructor.courses.create');
    }

    public function storeBasicInfo(Request $request)
    {
        // dd($request->all());

        $course = null;

        // Jika ada session course_id maka update
        if (Session::has('course_id')) {
            $course = Course::find(Session::get('course_id'));
        }

        // ================= VALIDASI UMUM =================
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug' . ($course ? ',' . $course->id : ''),
            'seo_description' => 'nullable|string|max:255',

            'thumbnail' => $course
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'demo_video_storage' => 'nullable|in:upload,youtube,vimeo,external_link',

            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // ================= HANDLE THUMBNAIL =================
        $thumbnailPath = $course?->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->uploadFile(
                $request->file('thumbnail'),
                $course?->thumbnail,
                'course-thumbnail'
            );
        }

        // ================= VALIDASI DEMO VIDEO =================
        if ($request->demo_video_storage === 'upload') {

            // Wajib FILE (path dari UniSharp)
            $request->validate([
                'file' => 'required|string|max:255',
            ]);
        } elseif (in_array($request->demo_video_storage, ['youtube', 'vimeo', 'external_link'])) {

            // Wajib URL
            $request->validate([
                'url' => 'required|string|max:255',
            ]);
        }

        // ================= TENTUKAN DEMO VIDEO SOURCE =================
        $demoVideoSource = $course?->demo_video_source;

        if ($request->demo_video_storage === 'upload') {

            // dari UniSharp (path file)
            $demoVideoSource = $request->file;
        } else {

            // dari input URL
            $demoVideoSource = $request->url;
        }

        // ================= DATA =================
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'seo_description' => $request->seo_description,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'demo_video_storage' => $request->demo_video_storage,
            'demo_video_source' => $demoVideoSource,
            'price' => $request->price,
            'discount' => $request->discount,
        ];

        if ($course) {
            $course->update($data);
        } else {
            $course = Course::create(array_merge($data, [
                'instructor_id' => user()->id,
                'course_type' => 'course',
            ]));

            Session::put('course_id', $course->id);
        }

        AlertService::updated('Basic Info Saved Successfully');

        return to_route('instructor.courses.create.more-info', $course->id);
    }

    function createMoreInfo()
    {
        if (!session('course_id')) {
            return back();
        }
 
        $course = Course::find(session('course_id'));
        $categories = CourseCategory::where('is_active', 1)->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();
        return view('frontend.instructor.dashboard.course.create-course-tab.more-info', compact('categories', 'levels', 'languages', 'course'));
    }

    public function storeMoreInfo(Request $request)
    {
        // Ambil course berdasarkan session
        $course = Course::find(Session::get('course_id'));

        if (!$course) {
            AlertService::error('Course not found!');
            return back();
        }

        // Validasi input
        $validated = $request->validate([
            'capacity'           => 'nullable|integer|min:1',
            'duration'           => 'required|string|min:1',
            'qna'                => 'nullable|boolean',
            'certificate'        => 'nullable|boolean',
            'category_id'        => 'required|exists:course_categories,id',
            'course_level_id'    => 'required|exists:course_levels,id',
            'course_language_id' => 'required|exists:course_languages,id',
        ]);

        // Update course
        $course->update([
            'capacity'           => $validated['capacity'] ?? null,
            'duration'           => $validated['duration'],
            'qna'                => $validated['qna'] ?? 0,
            'certificate'        => $validated['certificate'] ?? 0,
            'category_id'        => $validated['category_id'],
            'course_level_id'    => $validated['course_level_id'],
            'course_language_id' => $validated['course_language_id'],
        ]);

        AlertService::updated('More Info Saved Successfully');

        // Redirect kembali ke halaman form
        return to_route('instructor.courses.create.course-content', $course->id);
    }

    function createCourseContent()
    {
        $course = Course::find(Session::get('course_id'));

        if (!$course) {
            AlertService::error('Course not found!');
            return back();
        }

        $chapters = CourseChapter::where(['course_id' => $course->id, 'instructor_id' => user()->id])->get();


        return view('frontend.instructor.dashboard.course.create-course-tab.course-content', compact('course', 'chapters'));
    }

    function createFinish()
    {
        if (!session('course_id')) {
            return back();
        }

        $course = Course::find(session('course_id'));
        return view('frontend.instructor.dashboard.course.create-course-tab.finish', compact('course'));
    }

    public function storeFinish(Request $request)
    {
        // Ambil course berdasarkan session
        $course = Course::find(Session::get('course_id'));

        if (!$course) {
            AlertService::error('Course not found!');
            return back();
        }

        // Validasi input
        $validated = $request->validate([
            'message_for_reviewer'    => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
        ]);

        // Update course
        $course->update([
            'message_for_reviewer'    => $validated['message_for_reviewer'],
            'status' => $validated['status'],
        ]);


        AlertService::updated('Course Created Successfully');

        // Redirect kembali ke halaman form
        return to_route('instructor.courses.index');
    }
}
