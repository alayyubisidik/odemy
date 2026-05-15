@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }} > {{ $chapter->title }} > Lessons (List)</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.chapters.index', $course) }}" class="btn btn-warning">Back</a>
                    <a href="{{ route('admin.courses.lessons.create', [$course, $chapter]) }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Storage</th>
                                <th>File Path</th>
                                <th>File Type</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lessons as $lesson)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->description }}</td>
                                    <td>{{ $lesson->storage }}</td>
                                    <td>{{ $lesson->file_path }}</td>
                                    <td>{{ $lesson->file_type }}</td>
                                    <td>{{ $lesson->duration }}</td>
                                    <td>
                                        @if ($lesson->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.courses.lessons.edit', [$course, $chapter, $lesson]) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.lessons.destroy', [$course, $chapter, $lesson]) }}" method="POST">
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
                                    <td class="text-center" colspan="9">No Data Available</td>
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
