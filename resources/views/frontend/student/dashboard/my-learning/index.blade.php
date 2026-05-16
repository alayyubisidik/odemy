@extends('frontend.student.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>My Learning</h5>
                <p>Access your enrolled courses and continue learning at your own pace.</p>
            </div>
        </div>

        <div class="wsus__dash_course_table">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="image">
                                        Courses
                                    </th>
                                    <th class="action">

                                        ACTION
                                    </th>
                                </tr>
                                @forelse ($enrollments as $enrollment)
                                    <tr>
                                        <td class="image" style="display: flex; gap: 100px;">
                                            <div class="image_category">
                                                <img src="{{ asset($enrollment->course->thumbnail) }}" alt="img"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="">
                                                <a class="title m-0 p-0 mb-2" href="{{ route('courses.show', $enrollment->course->slug) }}">{{ $enrollment->course->title }}</a>
                                                <p class="text-muted">By {{ $enrollment->course->instructor->name }}</p>

                                                @php
                                                    $wathedLessons = \App\Models\WatchHistory::where(['user_id' => user()->id, 'course_id' => $enrollment->course->id, 'is_completed' => 1])->count();
                                                    $LessonCount = $enrollment->course->lessons()->count();
                                                @endphp

                                                @if ($wathedLessons == $LessonCount)
                                                    <a style="margin-top: 30px" href="{{ route('student.get-certificate', $enrollment->course->id) }}" class="common_btn bg-warning">Get Certificate</a>
                                                @endif

                                            </div>
                                        </td>
                                        <td class="details">
                                            <a href="{{ route('student.player.index', $enrollment->course->slug) }}" class="common_btn">Watch Course</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center">No Data Avalaible</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
