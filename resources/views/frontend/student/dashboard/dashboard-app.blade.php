@extends('frontend.layouts.app')

@section('content')
       <x-breadcrumb title="Student Dashboard" />


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
                                <a href="{{ route('student.dashboard.index') }}"
                                    class="{{ setActive(['student.dashboard.*']) }}">
                                    <div class="icon-wrapper">
                                        <i class="ti ti-chart-pie-2 icon-fe"></i>
                                    </div>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.profile.index') }}"
                                    class="{{ setActive(['student.profile.*']) }}">
                                    <div class="icon-wrapper">
                                        <i class="ti ti-user icon-fe"></i>
                                    </div>
                                    Profile
                                </a>
                            </li> 
                            <li>
                                <a href="{{ route('student.my-learning.index') }}"
                                    class="{{ setActive(['student.my-learning.*']) }}">
                                    <div class="icon-wrapper">
                                      <i class="ti ti-brand-parsinta icon-fe"></i>
                                    </div>
                                    My Learning
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.reviews.index') }}"
                                    class="{{ setActive(['student.reviews.*']) }}">
                                    <div class="icon-wrapper">
                                      <i class="ti ti-message icon-fe"></i>
                                    </div>
                                    My Reviews
                                </a>
                            </li>
                            @if (user()->approve_status == 'approved')
                            @endif
                            @if (user()->document)
                                <li>
                                    <a href="{{ route('student.switch-to-instructor.index') }}">
                                        <div class="img">
                                            <img src="{{ asset('assets/frontend/dist/images/dash_icon_8.png') }}"
                                                alt="icon" class="img-fluid w-100">
                                        </div>
                                        Switch to Instructor
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('student.become-instructor.index') }}"
                                        class="{{ setActive(['student.become-instructor.*']) }}">
                                        <div class="icon-wrapper">
                                           <i class="ti ti-chalkboard-teacher icon-fe"></i>
                                        </div>
                                        Become Instructor
                                    </a>
                                </li>
                            @endif
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
