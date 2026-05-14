<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class CourseSubCategoryController extends Controller
{
    use FileUploadTrait;

    function index(CourseCategory $courseCategory)
    {
        $courseSubCategories = CourseCategory::where('parent_id', $courseCategory->id)->paginate(20);
        return view('admin.dashboard.course-sub-category.index', compact('courseCategory', 'courseSubCategories'));
    }

    function create(CourseCategory $courseCategory)
    {
        return view('admin.dashboard.course-sub-category.create', compact('courseCategory'));
    }

    function store(Request $request, CourseCategory $courseCategory)
    {
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
            'parent_id'  => $courseCategory->id,
            'is_active'   => $request->has('is_active') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
        ]);

        AlertService::created();

        return redirect()->route('admin.course-sub-categories.index', $courseCategory);
    }

    function edit(CourseCategory $courseCategory, CourseCategory $courseSubCategory)
    {
        return view('admin.dashboard.course-sub-category.edit', compact('courseCategory', 'courseSubCategory'));
    }

    function update(Request $request, CourseCategory $courseCategory, CourseCategory $courseSubCategory)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'slug'       => ['required', 'string', 'max:255', 'unique:course_categories,slug,' . $courseSubCategory->id],
            'icon' => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg', 'max:2048'],
            'is_active'  => ['nullable', 'boolean'],
            'is_trending' => ['nullable', 'boolean'],
        ]);

        $courseSubCategory->name = $request->name;

        if ($request->hasFile("icon")) {
            $path = $this->uploadFile($request->file("icon"), $courseSubCategory->icon, "category-logo");
            $courseSubCategory->icon = $path;
        }

        $courseSubCategory->slug = $request->slug;
        $courseSubCategory->is_active = $request->has("is_active") ? 1 : 0;
        $courseSubCategory->is_trending = $request->has("is_trending") ? 1 : 0;
        $courseSubCategory->save();

        AlertService::updated();

        return to_route("admin.course-sub-categories.index", $courseCategory);
    }

    public function destroy(CourseCategory $courseSubCategory)
    {
        $this->deleteFile($courseSubCategory->icon);

        $courseSubCategory->delete();
        AlertService::deleted();

        return back();
    }
}
