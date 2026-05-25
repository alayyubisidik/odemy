@extends('frontend.student.dashboard.dashboard-app')

@section('dashboard-content')
    {{-- DASHBOARD CARDS --}}
    <div class="row g-4 mb-4">

        {{-- ENROLLED COURSES --}}
        <div class="col-xl-6 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">

                <h6>ENROLLED COURSES</h6>

                <h3>
                    {{ number_format($enrolledCourses) }}
                </h3>

                <p>Total purchased courses</p>

            </div>

        </div>


        {{-- COMPLETED COURSES --}}
        <div class="col-xl-6 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">

                <h6>COMPLETED COURSES</h6>

                <h3>
                    {{ number_format($completedCourses) }}
                </h3>

                <p>Successfully completed courses</p>

            </div>

        </div>


        {{-- IN PROGRESS COURSES --}}
        <div class="col-xl-6 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">

                <h6>IN PROGRESS</h6>

                <h3>
                    {{ number_format($inProgressCourses) }}
                </h3>

                <p>Courses currently in progress</p>

            </div>

        </div>


        {{-- TOTAL LEARNING HOURS --}}
        <div class="col-xl-6 col-sm-6 wow fadeInUp">

            <div class="wsus__dash_earning">

                <h6>LEARNING HOURS</h6>

                <h3>
                    {{ convertMinutesToHours($totalLearningHours) }}
                </h3>

                <p>Total learning duration</p>

            </div>

        </div>

    </div>



    <div class="row g-4 mb-5">

        {{-- COMPLETED COURSE PROGRESS --}}
        <div class="col-12 wow fadeInRight">

            <div class="wsus__dashboard_barfiller">

                <h5>Completed Course Progress</h5>

                @forelse($completedCourseProgress as $index => $course)
                    <div class="single_bar">

                        <p>
                            {{ Str::limit($course->title, 25) }}
                        </p>

                        <div id="bar{{ $index + 1 }}" class="barfiller">

                            <div class="tipWrap">
                                <span class="tip"></span>
                            </div>

                            <span
                                class="fill
                                @if ($index == 0) orrange
                                @elseif($index == 1)
                                    megenda
                                @elseif($index == 2)
                                    merun @endif"
                                data-percentage="{{ $course->progress }}">
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="text-muted">
                        No progress data available
                    </div>
                @endforelse

            </div>

        </div>



        {{-- RECENT PURCHASES --}}
        <div class="col-12 wow fadeInLeft">

            <div class="wsus__dashboard_contant">

                <div class="wsus__dashboard_contant_top mb-3 d-flex justify-content-between align-items-center">

                    <div class="wsus__dashboard_heading">

                        <h5>Recent Purchases</h5>

                        <p>Your latest purchased courses.</p>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>Course</th>

                                <th>Price</th>

                                <th>Purchase Date</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentPurchases as $purchase)
                                <tr>

                                    <td style="max-width: 300px">
                                        {{ Str::limit($purchase->course->title, 40) }}
                                    </td>

                                    <td>
                                        {{ rupiah($purchase->price) }}
                                    </td>

                                    <td>
                                        {{ $purchase->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        @if ($purchase->order->status == 'approved')
                                            <span class="badge bg-success">
                                                Paid
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-4 text-muted">
                                        No purchases available
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
