@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Custom Page</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.custom-pages.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($custom_pages as $custom_page)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $custom_page->title }}</td>
                                    <td>{{ $custom_page->slug }}</td>
                                    <td>
                                        @if ($custom_page->status == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a  href="{{ route('admin.custom-pages.edit', $custom_page) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.custom-pages.destroy', $custom_page) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a  type="submit" class="text-danger delete-btn "
                                                    data-name="{{ $custom_page->name }}">
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

            </div>
        </div>
    </div>
@endsection
