@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>Add Courses</h5>
                <p>Manage and complete your course details across the tabs below.</p>
                <a class="common_btn" href="{{ route('instructor.courses.index') }}">Back</a>
            </div>
        </div>

        <div class="dashboard_add_courses">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a href="{{ route('instructor.courses.create') }}"
                        class="nav-link {{ setActive(['instructor.courses.create']) }}">Basic Info</a>
                </li>
                <li class="nav-item">
                    <a href="{{ session('course_id') ? route('instructor.courses.create.more-info', session('course_id')) : 'javascript:void(0)' }}"
                        class="nav-link {{ session('course_id') ? setActive(['instructor.courses.create.more-info', session('course_id')]) : '' }}">
                        More Info
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ session('course_id') ? route('instructor.courses.create.course-content', session('course_id')) : 'javascript:void(0)' }}"
                        class="nav-link {{ session('course_id') ? setActive(['instructor.courses.create.course-content', session('course_id')]) : '' }}">
                        Course Content
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ session('course_id') ? route('instructor.courses.create.finish', session('course_id')) : 'javascript:void(0)' }}"
                        class="nav-link {{ session('course_id') ? setActive(['instructor.courses.create.finish', session('course_id')]) : '' }}">
                        Finish
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @yield('create-course-tab-content')
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            window.addEventListener("load", function() {
                // kasih sedikit delay agar layout fix dulu (bootstrap, select2, thumbnail image height)
                window.scrollTo({
                    top: 300,
                    behavior: "smooth"
                });
            });
        </script>
    @endpush
