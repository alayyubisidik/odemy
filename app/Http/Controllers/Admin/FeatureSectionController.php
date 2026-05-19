<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class FeatureSectionController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = FeatureSection::first();
        return view('admin.dashboard.section.feature.index', compact('feature'));
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
            'title_one' => 'required|string|max:255',
            'subtitle_one' => 'required|string|max:255',
            'title_two' => 'required|string|max:255',
            'subtitle_two' => 'required|string|max:255',
            'title_three' => 'required|string|max:255',
            'subtitle_three' => 'required|string|max:255',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Ambil data Feature lama jika ada
        $feature = FeatureSection::find(1);

        // Handle upload image satu-satu
        foreach (['image_one', 'image_two', 'image_three'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $oldPath = $feature?->$imageField ?? null;
                $validated[$imageField] = $this->uploadFile($request->file($imageField), $oldPath, 'feature_images');
            }
        }

        // Update atau create Feature ID 1
        FeatureSection::updateOrCreate(
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
