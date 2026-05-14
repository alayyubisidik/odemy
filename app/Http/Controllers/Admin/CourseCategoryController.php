<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{

    use FileUploadTrait;

    public function index()
    {
        $course_categories = CourseCategory::where('parent_id', null)->paginate(20);
        return view('admin.dashboard.course-category.index', compact('course_categories'));
    }

    public function create()
    {
        return view('admin.dashboard.course-category.create');
    }

    public function store(Request $request)
    {
        // VALIDATION
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'slug'       => ['required', 'string', 'max:255', 'unique:course_categories,slug'],
            'icon' => ['required', 'file', 'mimes:svg,png,jpg,jpeg', 'max:2048'],
            'is_active'  => ['nullable', 'boolean'],
            'is_trending' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile("icon")) {
            $path = $this->uploadFile($request->file("icon"), null, "category-icon");
            $data['icon'] = $path;
        }

        CourseCategory::create([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'icon'        => $data['icon'],
            'is_active'   => $request->has('is_active') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
        ]);

        AlertService::created();

        return redirect()->route('admin.course-categories.index');
    }


    public function edit(CourseCategory $course_category)
    {
        return view('admin.dashboard.course-category.edit', compact('course_category'));
    }

    public function update(Request $request, CourseCategory $course_category)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'slug'       => ['required', 'string', 'max:255', 'unique:course_categories,slug,' . $course_category->id],
            'icon' => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg', 'max:2048'],
            'is_active'  => ['nullable', 'boolean'],
            'is_trending' => ['nullable', 'boolean'],
        ]);

        $course_category->name = $request->name;

        if ($request->hasFile("icon")) {
            $path = $this->uploadFile($request->file("icon"), $course_category->icon, "category-logo");
            $course_category->icon = $path;
        }

        $course_category->slug = $request->slug;
        $course_category->is_active = $request->has("is_active") ? 1 : 0;
        $course_category->is_trending = $request->has("is_trending") ? 1 : 0;
        $course_category->save();

        AlertService::updated();

        return to_route("admin.course-categories.index");
    }

    public function destroy(CourseCategory $course_category)
    {
        if (CourseCategory::where('parent_id', $course_category->id)->exists()) {
            AlertService::error('This category cannot be deleted because it still has sub categories.');
            return back();
        }

        $this->deleteFile($course_category->icon);

        $course_category->delete();
        AlertService::deleted();

        return back();
    }
}
