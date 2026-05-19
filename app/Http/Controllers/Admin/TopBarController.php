<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopBar;
use App\Services\AlertService;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topBar = TopBar::first();
        return view('admin.dashboard.header-and-footer.top-bar.index', compact('topBar'));
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
            'email' => 'required|email',
            'phone' => 'required',
            'offer_name' => 'required',
            'offer_short_description' => 'required',
            'offer_button_text' => 'required',
            'offer_button_url' => 'required|url',
        ]);

        TopBar::updateOrCreate(
            ['id' => 1], // Assuming you want to update the record with ID 1
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
