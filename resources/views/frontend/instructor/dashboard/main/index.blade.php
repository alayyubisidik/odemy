@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    {{-- ALERT --}}
    @if (user()->approve_status == 'pending')
        <div class="alert alert-important alert-warning alert-dismissible d-flex align-items-start gap-3 mb-4" role="alert">

            <div class="alert-icon">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">

                    <path d="M12 9v4"></path>

                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                    </path>

                    <path d="M12 16h.01"></path>

                </svg>

            </div>

            <div>

                <h5 class="alert-heading mb-1">
                    Your Instructor Request is Pending
                </h5>

                <p class="alert-description mb-0">
                    Please wait for the admin to approve your request.
                </p>

            </div>

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>

        </div>
    @endif

    @if (user()->approve_status == 'rejected')
        <div class="alert alert-important alert-danger alert-dismissible d-flex align-items-start gap-3 mb-4"
            role="alert">

            <div class="alert-icon">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">

                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>

                    <path d="M12 8v4"></path>

                    <path d="M12 16h.01"></path>

                </svg>

            </div>

            <div>

                <h5 class="alert-heading mb-1">
                    Instructor Request Rejected
                </h5>

                <p class="alert-description mb-0">

                    Unfortunately, your request to become an instructor has been rejected.

                    <br>

                    If you need further assistance, you may contact our customer service through the

                    <a href="" class="text-primary text-decoration-underline">

                        Contact

                    </a>

                    page.

                </p>

            </div>

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>

        </div>
    @endif

    <div class="row g-4 mb-4">

        {{-- TOTAL COURSES --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>TOTAL COURSES</h6>

                <h3>
                    {{ number_format($totalCourses) }}
                </h3>

                <p>Your published learning content</p>
            </div>

        </div>


        {{-- TOTAL STUDENTS --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>TOTAL STUDENTS</h6>

                <h3>
                    {{ number_format($totalStudents) }}
                </h3>

                <p>Students enrolled in your courses</p>
            </div>

        </div>


        {{-- TOTAL REVENUE --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>TOTAL REVENUE</h6>

                <h3>
                    {{ rupiah($totalRevenue) }}
                </h3>

                <p>Total approved earnings</p>
            </div>

        </div>


        {{-- TOTAL ENROLLMENTS --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>TOTAL ENROLLMENTS</h6>

                <h3>
                    {{ number_format($totalEnrollments) }}
                </h3>

                <p>Total course enrollments</p>
            </div>

        </div>


        {{-- TOTAL REVIEWS --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>TOTAL REVIEWS</h6>

                <h3>
                    {{ number_format($totalReviews) }}
                </h3>

                <p>Reviews submitted by students</p>
            </div>

        </div>


        {{-- PENDING REVIEWS --}}
        <div class="col-xl-4 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">
                <h6>PENDING REVIEWS</h6>

                <h3>
                    {{ number_format($pendingReviews) }}
                </h3>

                <p>Reviews waiting for approval</p>
            </div>

        </div>

    </div>


    <div class="row g-4 mb-5">

        {{-- RECENT ENROLLMENTS --}}
        <div class="col-12">

            <div class="wsus__dashboard_contant h-100">

                <div class="wsus__dashboard_contant_top mb-3 d-flex justify-content-between align-items-center">

                    <div class="wsus__dashboard_heading">
                        <h5>Recent Enrollments</h5>
                        <p>Latest students enrolled in your courses.</p>
                    </div>

                    <a href="{{ route('instructor.orders.index') }}" class="common_btn btn_sm">
                        View All
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentEnrollments as $enrollment)
                                <tr>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <img src="{{ asset($enrollment->user->image) }}"
                                                alt="{{ $enrollment->user->name }}" width="35" height="35" style="width: 25px !important;"
                                                class="rounded-circle object-fit-cover">

                                            <span>
                                                {{ $enrollment->user->name }}
                                            </span>

                                        </div>
                                    </td>

                                    <td style="max-width: 220px">
                                        {{ Str::limit($enrollment->course->title, 35) }}
                                    </td>

                                    <td>
                                        {{ $enrollment->created_at->diffForHumans() }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        No enrollments available
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- RECENT REVIEWS --}}
        <div class="col-12">

            <div class="wsus__dashboard_contant h-100">

                <div class="wsus__dashboard_contant_top mb-3 d-flex justify-content-between align-items-center">

                    <div class="wsus__dashboard_heading">
                        <h5>Recent Reviews</h5>
                        <p>Latest reviews from students.</p>
                    </div>

                    <a href="{{ route('instructor.reviews.index') }}" class="common_btn btn_sm">
                        View All
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Rating</th>
                                <th>Review</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentReviews as $review)
                                <tr>

                                    <td>
                                        {{ $review->user->name }}
                                    </td>

                                    <td style="max-width: 220px">
                                        {{ Str::limit($review->course->title, 30) }}
                                    </td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $review->rating }}/5
                                        </span>
                                    </td>

                                    <td style="max-width: 250px">
                                        {{ Str::limit($review->review, 50) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        No reviews available
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- TOP SELLING COURSES --}}
        <div class="col-12">

            <div class="wsus__dashboard_contant h-100">

                <div class="wsus__dashboard_contant_top mb-3 d-flex justify-content-between align-items-center">

                    <div class="wsus__dashboard_heading">
                        <h5>Top Selling Courses</h5>
                        <p>Best performing courses based on enrollments.</p>
                    </div>

                    <a href="{{ route('instructor.courses.index') }}" class="common_btn btn_sm">
                        View All
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Total Sales</th>
                                <th>Total Revenue</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($topSellingCourses as $course)
                                <tr>

                                    <td style="max-width: 300px">
                                        {{ Str::limit($course->title, 40) }}
                                    </td>

                                    <td>
                                        {{ $course->total_sales }}
                                    </td>

                                    <td>
                                        {{ rupiah($course->total_revenue) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        No sales data available
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
