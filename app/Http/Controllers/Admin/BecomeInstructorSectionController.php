<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BecomeInstructorSection;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class BecomeInstructorSectionController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $becomeInstructorSection = BecomeInstructorSection::first();
        return view('admin.dashboard.section.become-instructor.index', compact('becomeInstructorSection'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:255',
        ]);

        $becomeInstructorSection = BecomeInstructorSection::first();

        if ($request->hasFile('image')) {
            $oldPath = $becomeInstructorSection?->image ?? null;

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $oldPath,
                'become_instructor_section_image'
            );
        }

        BecomeInstructorSection::updateOrCreate(
            ['id' => $becomeInstructorSection?->id],
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
