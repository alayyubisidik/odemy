@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Courses</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Instructor</th>
                                <th>Price</th>
                                <th>Approved Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img width="100" src="{{ asset($course->thumbnail) }}" alt="">
                                    </td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category->name }}</td>
                                    <td>{{ $course->Instructor->name }}</td>
                                    <td>{{ rupiah($course->price) }}</td>
                                    <td>
                                        <form action="{{ route('admin.courses.update-approve-status', $course->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')

                                            <select name="status" class="form-select "
                                                onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $course->is_approved === 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="approved"
                                                    {{ $course->is_approved === 'approved' ? 'selected' : '' }}>
                                                    Approved
                                                </option>
                                                <option value="rejected"
                                                    {{ $course->is_approved === 'rejected' ? 'selected' : '' }}>
                                                    Rejected
                                                </option>
                                            </select>
                                        </form>
                                    </td>


                                    <td>
                                        @if ($course->status == 'active')
                                            <span class="badge bg-success-lt">active</span>
                                        @elseif ($course->status == 'inactive')
                                            <span class="badge bg-danger-lt">inactive</span>
                                        @elseif ($course->status == 'draft')
                                            <span class="badge bg-warning-lt">draft</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.courses.edit', $course) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.courses.chapters.index', $course) }}">
                                                <i class="ti ti-list-check"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.destroy', $course) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
