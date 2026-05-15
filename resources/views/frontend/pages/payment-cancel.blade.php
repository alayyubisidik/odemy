@extends('frontend.layouts.app')


@section('content')
    <x-breadcrumb title="Payment Cancelled" />

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
                                    background:#fff4e5;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                ">

                                <i class="fas fa-exclamation"
                                    style="font-size:40px;color:#f39c12;">
                                </i>

                            </div>

                        </div>

                        <h2 class="mb-3 fw-bold">
                            Payment Cancelled
                        </h2>

                        <p class="text-muted mb-4">
                            Your payment has been cancelled. You can continue
                            your checkout anytime and complete the payment later.
                        </p>

                        <div class="d-flex justify-content-center gap-3 flex-wrap">

                            <a href="{{ route('checkout.index') }}"
                                class="common_btn">

                                Continue Payment
                            </a>

                            <a href="{{ route('index') }}"
                                class="common_btn bg-dark">

                                Back To Home
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
