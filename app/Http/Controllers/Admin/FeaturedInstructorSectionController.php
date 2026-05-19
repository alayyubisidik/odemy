<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FeaturedInstructorSection;
use App\Models\User;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class FeaturedInstructorSectionController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = User::where('role', 'instructor')->get();
        $featuredInstructorSection = FeaturedInstructorSection::first();
        $selectedCourses = $featuredInstructorSection->featured_courses ?? [];
        if (is_string($selectedCourses)) {
            $selectedCourses = json_decode($selectedCourses, true) ?? [];
        } elseif (!is_array($selectedCourses)) {
            $selectedCourses = [];
        }
        $selectedInstructorCourses = Course::select(['id', 'title'])->where('instructor_id', $featuredInstructorSection?->instructor_id)->get();
        return view('admin.dashboard.section.featured-instructor.index', compact('featuredInstructorSection', 'instructors', 'selectedCourses', 'selectedInstructorCourses'));
    }

    public function getInstructorCourses(int $instructor_id)
    {
        $courses = Course::select(['id', 'title'])->where('instructor_id', $instructor_id)->where('is_approved', 'approved')->get();
        return response([
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'instructor_id' => 'required|exists:users,id',
            'featured_courses' => 'nullable|array',
            'featured_courses.*' => 'exists:courses,id',
            'instructor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $validated['featured_courses'] = $validated['featured_courses'] ?? [];

        $featuredInstructorSection = FeaturedInstructorSection::first();

        // IMAGE
        if ($request->hasFile('instructor_image')) {
            $oldPath = $featuredInstructorSection?->instructor_image ?? null;

            $validated['instructor_image'] = $this->uploadFile(
                $request->file('instructor_image'),
                $oldPath,
                'featured_instructor_images'
            );
        }

        FeaturedInstructorSection::updateOrCreate(
            ['id' => $featuredInstructorSection?->id],
            $validated
        );

        AlertService::updated();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
