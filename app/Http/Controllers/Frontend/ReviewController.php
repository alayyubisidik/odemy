<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'course'])
            ->whereHas('course', function ($query) {
                $query->where('instructor_id', user()->id);
            })
            ->latest()
            ->get();

        return view('frontend.instructor.dashboard.review.index', compact('reviews'));
    }

    public function changeStatus(Request $request, Review $review)
    {
        $request->validate([
            'status' => ['required', 'boolean']
        ]);

        $review->update([
            'status' => $request->status == "1" ? 1 : 0
        ]);

        notyf()->success('Review status updated successfully');

        return back();
    }
}
