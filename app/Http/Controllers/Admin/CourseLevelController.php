<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CourseLevelController extends Controller
{
    public function index()
    {
        $courseLevels = CourseLevel::all();
        return view('admin.dashboard.course-level.index', compact('courseLevels'));
    }

    public function create()
    {
        return view('admin.dashboard.course-level.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:course_languages,slug'],
        ]);

        CourseLevel::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        AlertService::created();

        return to_route('admin.course-levels.index');
    }


    public function edit(CourseLevel $courseLevel)
    {
        return view('admin.dashboard.course-level.edit', compact('courseLevel'));
    }

    public function update(Request $request, CourseLevel $courseLevel)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:course_languages,slug,' . $courseLevel->id],
        ]);

        $courseLevel->update($data);

        AlertService::updated();

        return to_route("admin.course-levels.index");
    }

    public function destroy(CourseLevel $courseLevel)
    {
        $courseLevel->delete();
        AlertService::deleted();

        return back();
    }
}
