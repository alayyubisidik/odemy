<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnTwo;
use App\Services\AlertService;
use Illuminate\Http\Request;

class FooterColumnTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_column_twos = FooterColumnTwo::all();
        return view('admin.dashboard.header-and-footer.footer-column-two.index', compact('footer_column_twos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.header-and-footer.footer-column-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'required|boolean',
        ]);

        FooterColumnTwo::create($validated);

        AlertService::created();

        return redirect()->route('admin.footer-column-two.index');
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
    public function edit(FooterColumnTwo $footer_column_two)
    {
        return view('admin.dashboard.header-and-footer.footer-column-two.edit', compact('footer_column_two'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FooterColumnTwo $footer_column_two)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $footer_column_two->update([
            'text' => $validated['text'],
            'url' => $validated['url'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.footer-column-two.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FooterColumnTwo $footer_column_two)
    {
        $footer_column_two->delete();

        AlertService::deleted();
        return redirect()->route('admin.footer-column-two.index');
    }
}
