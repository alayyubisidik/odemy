<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AboutUsSectionController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutUsSection::first();
        return view('admin.dashboard.section.about-us.index', compact('about'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'lerner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'lerner_count' => 'required|integer',
            'lerner_count_text' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:255',
            'video_url' => 'required|string|max:255',
        ]);

        // Ambil data lama
        $about = AboutUsSection::find(1);

        // IMAGE
        if ($request->hasFile('image')) {
            $oldPath = $about?->image ?? null;

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $oldPath,
                'about_images'
            );
        }

        // LERNER IMAGE
        if ($request->hasFile('lerner_image')) {
            $oldPath = $about?->lerner_image ?? null;

            $validated['lerner_image'] = $this->uploadFile(
                $request->file('lerner_image'),
                $oldPath,
                'about_images'
            );
        }

        // VIDEO IMAGE
        if ($request->hasFile('video_image')) {
            $oldPath = $about?->video_image ?? null;

            $validated['video_image'] = $this->uploadFile(
                $request->file('video_image'),
                $oldPath,
                'about_images'
            );
        }

        // Update atau create
        AboutUsSection::updateOrCreate(
            ['id' => 1],
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
