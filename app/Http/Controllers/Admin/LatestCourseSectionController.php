<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;
use App\Services\AlertService;
use Illuminate\Http\Request;

class LatestCourseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::all();
        $latestCourseSection = LatestCourseSection::first();
        return view('admin.dashboard.section.latest-course.index', compact('categories', 'latestCourseSection'));
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
            'category_one' => 'required|exists:course_categories,id',
            'category_two' => 'required|exists:course_categories,id',
            'category_three' => 'required|exists:course_categories,id',
            'category_four' => 'required|exists:course_categories,id',
            'category_five' => 'required|exists:course_categories,id',
        ]);

        LatestCourseSection::updateOrCreate(['id' => 1], $validated);

        AlertService::updated();

        return redirect()->back();
    }

}
