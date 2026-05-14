@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Course Sub Category of ({{ $courseCategory->name }}) </h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-categories.index') }}"
                        class="btn btn-primary" style="margin-right: 7px">Back</a>
                    <a href="{{ route('admin.course-sub-categories.create', $courseCategory) }}"
                        class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Is Trending</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courseSubCategories as $courseSubCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img width="70" src="{{ asset($courseSubCategory->icon) }}" alt="">
                                    </td>
                                    <td>{{ $courseSubCategory->name }}</td>
                                    <td>{{ $courseSubCategory->slug }}</td>
                                    <td>
                                        @if ($courseSubCategory->is_trending == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($courseSubCategory->is_active == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a
                                                href="{{ route('admin.course-sub-categories.edit', [
                                                    'courseCategory' => $courseCategory,
                                                    'courseSubCategory' => $courseSubCategory,
                                                ]) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.course-sub-categories.destroy', $courseSubCategory) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn"
                                                    data-name="{{ $courseSubCategory->name }}">
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
