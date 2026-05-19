<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = HeroSection::find(1);
        return view('admin.dashboard.section.hero-section.index', compact('hero'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:100',
            'button_url' => 'required|url|max:255',
            'video_button_text' => 'required|string|max:100',
            'video_button_url' => 'required|url|max:255',
            'banner_item_title' => 'required|string|max:255',
            'banner_item_subtitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Ambil data heroSecHeroSection lama jika ada
        $hero = HeroSection::find(1);

        if ($request->hasFile('image')) {
            $oldPath = $hero?->image ?? null; // Jika ada heroSecHeroSection lama, ambil path gambarnya
            $validated['image'] = $this->uploadFile($request->file('image'), $oldPath, 'hero_images');
        }

        HeroSection::updateOrCreate(
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
