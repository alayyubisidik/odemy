@extends('frontend.layouts.app')

@section('content')
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>Student Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 wow fadeInLeft">
                    <div class="wsus__dashboard_sidebar">
                        <div class="wsus__dashboard_sidebar_top">
                            <div class="dashboard_banner">
                                <img src="{{ asset('assets/frontend/dist/images/single_topic_sidebar_banner.jpg') }}" alt="img" class="img-fluid">
                            </div>
                            <div class="img">
                                <img src="{{ asset(user()->image) }}" alt="profile" class="img-fluid w-100">
                            </div>
                            <h4>{{ user()->name }}</h4>
                            <p>{{ user()->role }}</p>
                        </div>
                        <ul class="wsus__dashboard_sidebar_menu">
                            <li>
                                <a href="{{ route('student.dashboard.index') }}"
                                    class="{{ setActive(['student.dashboard.*']) }}">
                                    <div class="img">
                                        <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}" alt="icon"
                                            class="img-fluid w-100">
                                    </div>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.profile.index') }}"
                                    class="{{ setActive(['student.profile.*']) }}">
                                    <div class="img">
                                        <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}" alt="icon"
                                            class="img-fluid w-100">
                                    </div>
                                    Profile
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('student.my-learning.index') }}"
                                    class="{{ setActive(['student.my-learning.*']) }}">
                                    <div class="img">
                                        <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}" alt="icon"
                                            class="img-fluid w-100">
                                    </div>
                                    My Learning
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.reviews.index') }}"
                                    class="{{ setActive(['student.reviews.*']) }}">
                                    <div class="img">
                                        <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}" alt="icon"
                                            class="img-fluid w-100">
                                    </div>
                                    My Reviews
                                </a>
                            </li> --}}
                            @if (user()->approve_status == 'approved')
                                <li>
                                    <a href="{{ route('student.switch-to-instructor.index') }}">
                                        <div class="img">
                                            <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}" alt="icon"
                                                class="img-fluid w-100">
                                        </div>
                                        Switch to Instructor
                                    </a>
                                </li>
                            @endif
                            @if (!user()->document)
                                <li>
                                    <a href="{{ route('student.become-instructor.index') }}"
                                        class="{{ setActive(['student.become-instructor.*']) }}">
                                        <div class="img">
                                            <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}"
                                                alt="icon" class="img-fluid w-100">
                                        </div>
                                        Become Instructor
                                    </a>
                                </li>
                            @endif
                            <li style="cursor: pointer" onclick="event.preventDefault(); $('.form-logout').submit()">
                                <a href="#" style="cursor: pointer">
                                    <div class="img">
                                        <img src="{{ asset('assets/frontend/dist/images/dash_icon_16.png') }}"
                                            alt="icon" class="img-fluid w-100">
                                    </div>
                                    Sign Out
                                </a>
                                <form action="{{ route('logout') }}" class="form-logout" method="POST">
                                    @csrf
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
