<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_links = SocialLink::all();
        return view('admin.dashboard.header-and-footer.social-link.index', compact('social_links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.header-and-footer.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required|string|max:255',
        ]);

        if ($request->hasFile('icon')) {

            $validated['icon'] = $this->uploadFile(
                $request->file('icon'),
                null,
                'social_links'
            );
        }

        $social_link = new SocialLink();
        $social_link->link = $validated['link'];
        $social_link->icon = $validated['icon'];
        $social_link->save();

        AlertService::created();
        return redirect()->route('admin.social-links.index');
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
    public function edit(SocialLink $social_link)
    {
        return view('admin.dashboard.header-and-footer.social-link.edit', compact('social_link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $social_link)
    {
         $validated = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {

            $validated['icon'] = $this->uploadFile(
                $request->file('icon'),
                $social_link->icon,
                'social_links'
            );
        }

        $social_link->update([
            'icon' => $validated['icon'] ?? $social_link->icon,
            'link' => $validated['link'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.social-links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $social_link)
    {
        $this->deleteFile($social_link->icon);
        $social_link->delete();

        AlertService::deleted();
        return redirect()->route('admin.social-links.index');
    }
}
