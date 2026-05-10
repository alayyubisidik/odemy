@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Course Language</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-languages.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courseLanguages as $language)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $language->name }}</td>
                                    <td>{{ $language->slug }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.course-languages.edit', $language) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.course-languages.destroy', $language) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn"
                                                    data-name="{{ $language->name }}">
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
