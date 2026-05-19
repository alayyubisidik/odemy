<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnOne;
use App\Services\AlertService;
use Illuminate\Http\Request;

class FooterColumnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_column_ones = FooterColumnOne::all();
        return view('admin.dashboard.header-and-footer.footer-column-one.index', compact('footer_column_ones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.header-and-footer.footer-column-one.create');
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

        FooterColumnOne::create($validated);

        AlertService::created();

        return redirect()->route('admin.footer-column-one.index');
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
    public function edit(FooterColumnOne $footer_column_one)
    {
        return view('admin.dashboard.header-and-footer.footer-column-one.edit', compact('footer_column_one'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FooterColumnOne $footer_column_one)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $footer_column_one->update([
            'text' => $validated['text'],
            'url' => $validated['url'],
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.footer-column-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FooterColumnOne $footer_column_one)
    {
        $footer_column_one->delete();

        AlertService::deleted();
        return redirect()->route('admin.footer-column-one.index');
    }
}
