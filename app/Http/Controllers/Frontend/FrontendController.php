<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\AboutUsSection;
use App\Models\BecomeInstructorSection;
use App\Models\BrandSection;
use App\Models\ContactPage;
use App\Models\CounterSection;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomPage;
use App\Models\FeaturedInstructorSection;
use App\Models\FeatureSection;
use App\Models\HeroSection;
use App\Models\LatestCourseSection;
use App\Models\TestimonialSection;
use App\Models\VideoSection;
use App\Services\AlertService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    function index()
    {
        $hero = HeroSection::first();
        $feature = FeatureSection::first();
        $featuredCategories = CourseCategory::withCount(['subCategories as active_course_count' => function ($query) {
            $query->whereHas('courses', function ($q) {
                $q->where(["is_approved" => "approved", 'status' => 1]);
            });
        }])->where(['parent_id' => null, 'is_trending' => 1])->limit(8)->get();
        $about = AboutUsSection::first();
        $latestCourses = LatestCourseSection::first();
        $becomeInstructor = BecomeInstructorSection::first();
        $videoSection = VideoSection::first();
        $brands = BrandSection::where('status', 1)->get();
        $featuredInstructorSection = FeaturedInstructorSection::first();
        $featuredInstructorCourses = Course::whereIn('id', $featuredInstructorSection->featured_courses ?? [])->get();
        $testimonials = TestimonialSection::all();

        return view('frontend.home.index', compact('hero', 'feature', 'featuredCategories', 'about', 'latestCourses', 'becomeInstructor', 'videoSection', 'brands', 'featuredInstructorSection', 'featuredInstructorCourses', 'testimonials'));
    }

    public function aboutUs()
    {
        $about = AboutUsSection::first();
        $testimonials = TestimonialSection::all();
        $counter = CounterSection::first();

        return view('frontend.pages.about-us', compact('about', 'testimonials', 'counter'));
    }

    public function contact()
    {
        $contact = ContactPage::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

        Mail::to(config('settings.site_email'))->send(new ContactMail(
            $request->name,
            $request->email,
            $request->subject,
            $request->message
        ));

        AlertService::created('Your message has been sent successfully. We will get back to you soon.');
        return redirect()->back();
    }

    function customPage(string $slug)
    {
        $page = CustomPage::where('slug', $slug)->first();
        return view('frontend.pages.custom-page', compact('page'));
    }
}
