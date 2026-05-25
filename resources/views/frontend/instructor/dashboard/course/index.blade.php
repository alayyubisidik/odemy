@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>Courses</h5>
                <p>Manage your courses and its update like live, draft and insight.</p>
                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
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
                                        Thumbnail
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th class="sale">
                                        Approve Status
                                    </th>
                                    <th class="status">
                                        Status
                                    </th>
                                    <th class="action">
                                        ACTION
                                    </th>
                                </tr>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td class="image">
                                            <div class="image_category">
                                                <img src="{{ asset($course->thumbnail) }}" alt="img"
                                                    class="img-fluid w-100">
                                            </div>
                                        </td>
                                        <td class="details">
                                            {{-- <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                <i class="far fa-star" aria-hidden="true"></i>
                                                <span>(5.0)</span>
                                            </p> --}}
                                            <a class="title m-0 p-0" href="">{{ $course->title }}</a>
                                        </td>
                                        <td class="sale">
                                            <p class="title">{{ $course->category->name ?? '-' }}</p>
                                        </td>
                                        <td>
                                            @if ($course->is_approved == 'pending')
                                                <span class="badge bg-warning">pending</span>
                                            @elseif ($course->is_approved == 'approved')
                                                <span class="badge bg-success">approved</span>
                                            @elseif($course->is_approved == 'rejected')
                                                <span class="badge bg-danger">rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->status == 'active')
                                                <span class="badge bg-success">active</span>
                                            @elseif ($course->status == 'inactive')
                                                <span class="badge bg-danger">inactive</span>
                                            @elseif($course->status == 'draft')
                                                <span class="badge bg-warning">draft</span>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <a class="edit" href="{{ route('instructor.courses.edit', $course) }}"><i
                                                    class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
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



