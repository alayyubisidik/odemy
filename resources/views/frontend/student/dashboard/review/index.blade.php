@extends('frontend.student.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>My Reviews</h5>
                <p>View and manage your course reviews.</p>
            </div>
        </div>

        <div class="wsus__dash_course_table">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        Course Name
                                    </th>
                                    <th>
                                        Rating
                                    </th>
                                    <th>
                                        Review
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        ACTION
                                    </th>
                                </tr>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->course->title }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->review }}</td>
                                        <td>
                                            @if ($review->status == 0)
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($review->status == 1)
                                                <span class="badge bg-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a class="del" href="{{ route('student.reviews.delete', $review->id) }}"><i
                                                    class="fas fa-trash-alt" style="color: red"></i></a> --}}

                                            <form action="{{ route('student.reviews.delete', $review->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn">
                                                    <i class="fas fa-trash-alt" style="color: red"></i>
                                                </a>
                                            </form>
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
