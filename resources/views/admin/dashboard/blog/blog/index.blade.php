@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog Management</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($blog->image) }}" alt="Brand Image"
                                            style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->blogCategory->name }}</td>
                                    <td>
                                        @if ($blog->status == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.blogs.edit', $blog) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn"
                                                    data-name="{{ $blog->title }}">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Data Available</td>
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
