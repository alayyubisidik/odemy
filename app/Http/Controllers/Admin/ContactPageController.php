<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = ContactPage::first();
        return view('admin.dashboard.contact.index', compact('contact'));
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
            'icon_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_one' => 'nullable|string|max:255',
            'subtitle_one' => 'nullable|string|max:255',
            'icon_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_two' => 'nullable|string|max:255',
            'subtitle_two' => 'nullable|string|max:255',
            'icon_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_three' => 'nullable|string|max:255',
            'subtitle_three' => 'nullable|string|max:255',
            'icon_four' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_four' => 'nullable|string|max:255',
            'subtitle_four' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'map_link' => 'nullable|string'
        ]);


        $contact = ContactPage::first();

        if ($request->hasFile('icon_one')) {
            $oldPath = $contact?->icon_one ?? null;

            $validated['icon_one'] = $this->uploadFile(
                $request->file('icon_one'),
                $oldPath,
                'icon_card_contact'
            );
        }

        if ($request->hasFile('icon_two')) {
            $oldPath = $contact?->icon_two ?? null;

            $validated['icon_two'] = $this->uploadFile(
                $request->file('icon_two'),
                $oldPath,
                'icon_card_contact'
            );
        }

        if ($request->hasFile('icon_three')) {
            $oldPath = $contact?->icon_three ?? null;

            $validated['icon_three'] = $this->uploadFile(
                $request->file('icon_three'),
                $oldPath,
                'icon_card_contact'
            );
        }

        if ($request->hasFile('icon_four')) {
            $oldPath = $contact?->icon_four ?? null;

            $validated['icon_four'] = $this->uploadFile(
                $request->file('icon_four'),
                $oldPath,
                'icon_card_contact'
            );
        }

        if ($request->hasFile('image')) {
            $oldPath = $contact?->image ?? null;

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $oldPath,
                'image_contact'
            );
        }


        ContactPage::updateOrCreate(
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
