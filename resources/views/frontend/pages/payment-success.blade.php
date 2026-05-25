@extends('frontend.layouts.app')


@section('content')
    <x-breadcrumb title="Payment Success" />

    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">

                    <div class="card border-0 shadow-sm text-center p-5 rounded-4">

                        <div class="mb-4">

                            <div
                                style="
                                width:90px;
                                height:90px;
                                margin:auto;
                                border-radius:50%;
                                background:#e9f9ee;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                            ">

                                <i class="fas fa-check" style="font-size:40px;color:#28a745;">
                                </i>

                            </div>

                        </div>

                        <h2 class="mb-3 fw-bold">
                            Payment Successful
                        </h2>

                        <p class="text-muted mb-4">
                            Thank you for your purchase. Your payment has been
                            successfully processed and your course is now available.
                        </p>

                        <div class="d-flex justify-content-center gap-3 flex-wrap">

                            <a href="{{ route('student.my-learning.index') }}" class="common_btn">

                                View Courses
                            </a>

                            <a href="{{ route('courses.index') }}" class="common_btn bg-dark">

                                Continue Shopping
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
