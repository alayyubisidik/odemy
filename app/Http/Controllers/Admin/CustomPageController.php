<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custom_pages = CustomPage::all();
        return view('admin.dashboard.custom-page.index', compact('custom_pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.custom-page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:custom_pages,slug',
            'description' => 'required|string',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'status' => 'nullable|boolean'
        ]);

        CustomPage::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']), // biar rapih
            'description' => $validated['description'],
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::created();

        return redirect()->route('admin.custom-pages.index');
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
    public function edit(CustomPage $custom_page)
    {
        return view('admin.dashboard.custom-page.edit', compact('custom_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomPage $custom_page, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:custom_pages,slug,' . $custom_page->id,
            'description' => 'required|string',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'status' => 'nullable|boolean'
        ]);

        $custom_page->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'description' => $validated['description'],
            'seo_title' => $validated['seo_title'],
            'seo_description' => $validated['seo_description'],
            'status' => $validated['status'] ?? 0
        ]);

        AlertService::updated();

        return redirect()->route('admin.custom-pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomPage $custom_page)
    {
        $custom_page->delete();

        AlertService::deleted();
        return redirect()->route('admin.custom-pages.index');
    }
}
