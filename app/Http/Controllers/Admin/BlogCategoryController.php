<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Services\AlertService;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.dashboard.blog.category.index', compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        BlogCategory::create($validated);

        AlertService::created();

        return redirect()->route('admin.blog-categories.index');
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
    public function edit(BlogCategory $blog_category)
    {
        return view('admin.dashboard.blog.category.edit', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blog_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'boolean',
        ]);


        $blog_category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        AlertService::deleted();
        return redirect()->route('admin.blog-categories.index');
    }
}

