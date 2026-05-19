<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class BrandSectionController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = BrandSection::all();
        return view('admin.dashboard.section.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required|url',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                null,
                'brand_images'
            );
        }

        BrandSection::create($validated);

        AlertService::created();

        return redirect()->route('admin.brand-sections.index');
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
    public function edit(BrandSection $brand_section)
    {
        return view('admin.dashboard.section.brand.edit', compact('brand_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandSection $brand_section, Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $brand_section->image,
                'brand_images'
            );
        }

        $brand_section->update([
            'image' => $validated['image'] ?? $brand_section->image,
            'url' => $validated['url'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.brand-sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BrandSection $brand_section)
    {
        $this->deleteFile($brand_section->image);
        $brand_section->delete();

        AlertService::deleted();
        return redirect()->route('admin.brand-sections.index');
    }

}
