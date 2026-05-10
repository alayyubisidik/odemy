<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CourseLanguageController extends Controller
{
    public function index()
    {
        $courseLanguages = CourseLanguage::all();
        return view('admin.dashboard.course-language.index', compact('courseLanguages'));
    }

    public function create()
    {
        return view('admin.dashboard.course-language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:course_languages,slug'],
        ]);

        CourseLanguage::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        AlertService::created();

        return to_route('admin.course-languages.index');
    }


    public function edit(CourseLanguage $courseLanguage)
    {
        return view('admin.dashboard.course-language.edit', compact('courseLanguage'));
    }

    public function update(Request $request, CourseLanguage $courseLanguage)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:course_languages,slug,' . $courseLanguage->id],
        ]);

        $courseLanguage->update($data);

        AlertService::updated();

        return to_route("admin.course-languages.index");
    }

    public function destroy(CourseLanguage $courseLanguage)
    {
        $courseLanguage->delete();
        AlertService::deleted();

        return back();
    }
}
