<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\InstructorGatewayInformation;
use App\Models\OrderItem;
use App\Models\PayoutGateway;
use App\Models\Review;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstructorDashboardController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $instructorId = user()->id;

        /*
    |--------------------------------------------------------------------------
    | DASHBOARD STATS
    |--------------------------------------------------------------------------
    */

        // TOTAL COURSES
        $totalCourses = Course::where('instructor_id', $instructorId)->count();

        // TOTAL STUDENTS
        $totalStudents = Enrollment::where('instructor_id', $instructorId)
            ->distinct('user_id')
            ->count('user_id');

        // TOTAL REVENUE
        $totalRevenue = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')

            ->where('courses.instructor_id', $instructorId)
            ->where('orders.status', 'approved')

            ->selectRaw('SUM(
                order_items.price -
                (order_items.price * order_items.commission_rate / 100)
            ) as total_revenue')

            ->value('total_revenue');

        // TOTAL ENROLLMENTS
        $totalEnrollments = Enrollment::where('instructor_id', $instructorId)
            ->count();

        // TOTAL REVIEWS
        $totalReviews = Review::whereHas('course', function ($query) use ($instructorId) {

            $query->where('instructor_id', $instructorId);
        })->count();

        // PENDING REVIEWS
        // sesuaikan field status jika berbeda
        $pendingReviews = Review::whereHas('course', function ($query) use ($instructorId) {

            $query->where('instructor_id', $instructorId);
        })
            ->where('status', 'pending')
            ->count();


        /*
    |--------------------------------------------------------------------------
    | RECENT ENROLLMENTS
    |--------------------------------------------------------------------------
    */

        $recentEnrollments = Enrollment::with([
            'user',
            'course'
        ])
            ->where('instructor_id', $instructorId)
            ->latest()
            ->take(5)
            ->get();


        /*
    |--------------------------------------------------------------------------
    | RECENT REVIEWS
    |--------------------------------------------------------------------------
    */

        $recentReviews = Review::with([
            'user',
            'course'
        ])
            ->whereHas('course', function ($query) use ($instructorId) {

                $query->where('instructor_id', $instructorId);
            })
            ->latest()
            ->take(5)
            ->get();


        /*
    |--------------------------------------------------------------------------
    | TOP SELLING COURSES
    |--------------------------------------------------------------------------
    */

        $topSellingCourses = Course::select(
            'courses.id',
            'courses.title',
            DB::raw('COUNT(order_items.id) as total_sales'),
            DB::raw('SUM(order_items.price) as total_revenue')
        )

            ->join('order_items', 'courses.id', '=', 'order_items.course_id')

            ->join('orders', function ($join) {

                $join->on('orders.id', '=', 'order_items.order_id')
                    ->where('orders.status', 'approved');
            })

            ->where('courses.instructor_id', $instructorId)

            ->groupBy(
                'courses.id',
                'courses.title'
            )

            ->orderByDesc('total_sales')

            ->take(5)

            ->get();


        return view('frontend.instructor.dashboard.main.index', compact(
            'totalCourses',
            'totalStudents',
            'totalRevenue',
            'totalEnrollments',
            'totalReviews',
            'pendingReviews',

            'recentEnrollments',
            'recentReviews',
            'topSellingCourses'
        ));
    }



    function profile()
    {
        $user = user();
        $gatewayInfo = user()->gatewayInformation()->first();
        $gateways = PayoutGateway::all();
        return view('frontend.instructor.dashboard.profile.index', compact('user', 'gateways', 'gatewayInfo'));
    }

    function profileEdit()
    {
        $gatewayInfo = user()->gatewayInformation()->first();
        $gateways = PayoutGateway::all();
        return view('frontend.instructor.dashboard.profile.edit', compact('gatewayInfo', 'gateways'));
    }

    function profileUpdate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'bio' => 'nullable|string|max:1000',
            "image" => ["nullable", "image", "max:2048"],
            // Contoh social media links, jika ada
            'facebook' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'x' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Ambil user yang sedang login
        $user = user();

        if ($request->hasFile("image")) {
            $validated['image'] = $this->uploadFile($request->file("image"), $user->image, "user-images");
        }

        // Update data user
        /** @var \App\Models\User $user */
        $user->update($validated);

        AlertService::updated("Profile Updated Successfully");

        return back();
    }

    function passwordUpdate(Request $request)
    {
        $user = user();

        // Validasi
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:3|confirmed', // harus ada password_confirmation
        ]);

        // Update email
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        /** @var \App\Models\User $user */
        $user->save();

        // Notifikasi sukses
        AlertService::updated("Password or Email Updated Successfully");

        return back();
    }

    function switchToStudent()
    {
        $user = user();
        $user->role = 'student';
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('student.dashboard.index');
    }

    function orderIndex()
    {
        $orderItems = OrderItem::whereHas('product', function ($query) {
            $query->where('instructor_id', user()->id);
        })->paginate(25);

        return view('frontend.instructor.dashboard.order.index', compact('orderItems'));
    }

    function orderShow(int $id)
    {
        dd($id);
        $orderItems = OrderItem::whereHas('product', function ($query) {
            $query->where('instructor_id', user()->id);
        })->paginate(25);

        return view('frontend.instructor.dashboard.order.index', compact('orderItems'));
    }



    function storeGatewayInformation(Request $request)
    {
        $validated = $request->validate([
            'gateway' => ['required', 'string', 'max:255'],
            'gateway_information' => ['required', 'string']
        ]);

        InstructorGatewayInformation::updateOrCreate(
            [
                'instructor_id' => user()->id
            ],
            [
                'gateway' => $validated['gateway'],
                'gateway_information' => $validated['gateway_information']
            ]
        );

        AlertService::updated();
        return redirect()->back();
    }
}
