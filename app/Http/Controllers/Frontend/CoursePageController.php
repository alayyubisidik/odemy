<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\Enrollment;
use App\Models\Review;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    function index(Request $request)
    {
        $courses = Course::where('is_approved', 'approved')
            ->where('status', 'active')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                if (is_array($request->category)) {
                     $query->whereIn('category_id', $request->category);
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                $query->whereIn('course_level_id', $request->level);
            })
            ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                $query->whereIn('course_language_id', $request->language);
            })
            ->when($request->has('from') && $request->has('to') && $request->filled('from') && $request->filled('to'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->from, $request->to]);
            })
            ->orderBy('created_at', $request->get('order', 'desc'))
            ->paginate(12);
        $categories = CourseCategory::where('is_active', 1)->where('parent_id', null)->get();
        $levels = CourseLevel::all();
        $languages = CourseLanguage::all();
        return view('frontend.pages.course', compact('courses', 'categories', 'levels', 'languages'));
    }

    function show(string $slug)
    {
        $course = Course::where('slug', $slug)->where('is_approved', 'approved')->where('status', 'active')->first();
        // $reviews = Review::where('status', 1)->get();
        return view('frontend.pages.course-detail', compact('course'));
    }

    // function storeReview(Request $request)
    // {

    //     $request->validate([
    //         'course_id' => 'required|exists:courses,id',
    //         'rating' => 'required|integer|min:1|max:5',
    //         'review' => 'nullable|string',
    //     ]);

    //     $checkPurchase = Enrollment::where('course_id', $request->course_id)
    //         ->where('user_id', user()->id)
    //         ->first();

    //     if (!$checkPurchase) {
    //         AlertService::error('You can only review courses that you have purchased.');
    //         return redirect()->back();
    //     }

    //     $alreadyReviewed = Review::where('course_id', $request->course_id)
    //         ->where('user_id', user()->id)
    //         ->where('status', 1)
    //         ->first();

    //     if ($alreadyReviewed) {
    //         AlertService::error('You have already reviewed this course.');
    //         return redirect()->back();
    //     }

    //     $review = new Review();
    //     $review->course_id = $request->course_id;
    //     $review->user_id = user()->id;
    //     $review->rating = $request->rating;
    //     $review->review = $request->review;
    //     $review->save();

    //     AlertService::created('Your review has been submitted and is pending approval.');
    //     return redirect()->back();
    // }
}
