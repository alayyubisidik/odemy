<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounterSection;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CounterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counter_section = CounterSection::first();
        return view('admin.dashboard.section.counter.index', compact('counter_section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.counter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'counter_one' => 'required|string',
            'title_one' => 'required|string',
            'counter_two' => 'required|string',
            'title_two' => 'required|string',
            'counter_three' => 'required|string',
            'title_three' => 'required|string',
            'counter_four' => 'required|string',
            'title_four' => 'required|string',
        ]);

        CounterSection::updateOrCreate(
            ['id' => 1], // Assuming you want to update the first record or create if it doesn't exist
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
