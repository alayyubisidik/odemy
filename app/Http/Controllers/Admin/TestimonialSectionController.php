<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class TestimonialSectionController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = TestimonialSection::all();
        return view('admin.dashboard.section.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'user_name' => 'required|string|max:255',
            'user_title' => 'required|string|max:255',
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('user_image')) {
            $validated['user_image'] = $this->uploadFile($request->file('user_image'), null, 'testimonial-image-client');
        }

        TestimonialSection::create($validated);

        AlertService::created();

        return redirect()->route('admin.testimonial-sections.index');
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
    public function edit(TestimonialSection $testimonial_section)
    {
        // dd($testimonial_section->rating);
        return view('admin.dashboard.section.testimonial.edit', compact('testimonial_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialSection $testimonial_section, Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'user_name' => 'required|string|max:255',
            'user_title' => 'required|string|max:255',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('user_image')) {

            $validated['user_image'] = $this->uploadFile(
                $request->file('user_image'),
                $testimonial_section->user_image,
                'testimonial-image-client'
            );
        }

        $testimonial_section->update($validated);
        AlertService::updated();
        return redirect()->route('admin.testimonial-sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestimonialSection $testimonial_section)
    {
        $this->deleteFile($testimonial_section->user_image);
        $testimonial_section->delete();

        AlertService::deleted();
        return redirect()->route('admin.testimonial-sections.index');
    }
}
