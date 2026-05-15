@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }} > Chapters (List)</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-warning">Back</a>
                    <a href="{{ route('admin.courses.chapters.create', $course) }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chapters as $chapter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $chapter->title }}</td>
                                    <td>
                                        @if ($chapter->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.courses.chapters.edit', [$course, $chapter]) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.chapters.destroy', [$course->id, $chapter->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="text-danger delete-btn">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </form>
                                            <a href="{{ route('admin.courses.lessons.index', [$course, $chapter]) }}">
                                                <i class="ti ti-chalkboard-teacher"></i>
                                            </a>
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
