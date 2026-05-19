@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Footer Column Two Management</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.footer-column-two.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Text</th>
                                <th>URK</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($footer_column_twos as $footer_column_two)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $footer_column_two->text }}</td>
                                    <td>{{ $footer_column_two->url }}</td>
                                    <td>
                                        @if ($footer_column_two->status == 1)
                                            <span class="badge bg-primary-lt">Active</span>
                                        @else
                                            <span class="badge bg-danger-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.footer-column-two.edit', $footer_column_two) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.footer-column-two.destroy', $footer_column_two) }}"
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
