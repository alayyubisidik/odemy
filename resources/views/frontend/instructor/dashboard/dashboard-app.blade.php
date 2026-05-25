@extends('frontend.layouts.app')

@section('content')
    <x-breadcrumb title="Instructor Dashboard" />


    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 wow fadeInLeft">
                    <div class="wsus__dashboard_sidebar">
                        <div class="wsus__dashboard_sidebar_top">
                            <div class="dashboard_banner">
                                <img src="{{ asset('assets/frontend/dist/images/single_topic_sidebar_banner.jpg') }}"
                                    alt="img" class="img-fluid">
                            </div>
                            <div class="img">
                                <img src="{{ asset(user()->image) }}" alt="profile" class="img-fluid w-100">
                            </div>
                            <h4>{{ user()->name }}</h4>
                            <p>{{ user()->role }}</p>
                        </div>
                        <ul class="wsus__dashboard_sidebar_menu">
                            <li>
                                <a href="{{ route('instructor.dashboard.index') }}"
                                    class="{{ setActive(['instructor.dashboard.*']) }}">
                                    <div class="icon-wrapper">
                                        <i class="ti ti-chart-pie-2 icon-fe"></i>
                                    </div>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('instructor.profile.index') }}"
                                    class="{{ setActive(['instructor.profile.*']) }}">
                                    <div class="icon-wrapper">
                                        <i class="ti ti-user icon-fe"></i>
                                    </div>
                                    Profile
                                </a>
                            </li>

                            @if (user()->role == 'instructor' && user()->approve_status == 'approved')
                                <li>
                                    <a href="{{ route('instructor.courses.index') }}"
                                        class="{{ setActive(['instructor.courses.*']) }}">
                                        <div class="icon-wrapper">
                                            <i class="ti ti-brand-parsinta icon-fe"></i>
                                        </div>
                                        Courses
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('instructor.reviews.index') }}"
                                        class="{{ setActive(['instructor.reviews.*']) }}">
                                        <div class="icon-wrapper">
                                            <i class="ti ti-message icon-fe"></i>
                                        </div>
                                        Reviews
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('instructor.withdraws.index') }}"
                                        class="{{ setActive(['instructor.withdraws.*']) }}">
                                        <div class="icon-wrapper">
                                            <i class="ti ti-currency-dollar icon-fe"></i>
                                        </div>
                                        Withdraws
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('instructor.orders.index') }}"
                                        class="{{ setActive(['instructor.orders.*']) }}">
                                        <div class="icon-wrapper">
                                            <i class="ti ti-clipboard-text icon-fe"></i>
                                        </div>
                                        Orders
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('instructor.switch-to-student.index') }}">
                                    <div class="icon-wrapper">
                                        <i class="ti ti-school icon-fe"></i>
                                    </div>
                                    Switch to Student
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">

                                    @csrf

                                    <a href="#" style="cursor:pointer" onclick="confirmLogout(event)">

                                        <div class="icon-wrapper">
                                            <i class="ti ti-arrow-bar-right icon-fe"></i>
                                        </div>

                                        Sign Out
                                    </a>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @push('script')
    <script>
        window.addEventListener("load", function() {
            // kasih sedikit delay agar layout fix dulu (bootstrap, select2, thumbnail image height)
            window.scrollTo({
                top: 300,
                behavior: "smooth"
            });
        });
    </script>
@endpush --}}
