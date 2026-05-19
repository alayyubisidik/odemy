@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>Course Reviews</h5>
                <p>Manage and monitor student reviews, ratings, and feedback for your courses.</p>
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
                                        Review By
                                    </th>
                                    <th>
                                        Rating
                                    </th>
                                    <th>
                                        Review
                                    </th>
                                    <th class="status">
                                        Status
                                    </th>
                                    <th class="action">
                                        Action
                                    </th>
                                </tr>

                                @forelse($reviews as $review)
                                    <tr>
                                        <td>{{ $review->course->title }}</td>

                                        <td>{{ $review->user->name }}</td>

                                        <td>
                                            {{ $review->rating }}/5
                                        </td>

                                        <td style="max-width: 300px">
                                            {{ Str::limit($review->review, 80) }}
                                        </td>

                                        <td>
                                            @if ($review->status)
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('instructor.reviews.status', $review->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option value="0" {{ !$review->status ? 'selected' : '' }}>
                                                        Pending
                                                    </option>

                                                    <option value="1" {{ $review->status ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No reviews found
                                        </td>
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
