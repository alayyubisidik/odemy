@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh; ">

        <div class="card" style="margin-bottom: 10px">
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}" method="GET">

                    <div class="row g-3 align-items-end mb-1">

                        <!-- Search -->
                        <div class="col-md-5">

                            <label class="form-label">
                                Search
                            </label>

                            <div class="input-group">

                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name or email..." value="{{ request('search') }}">

                                <button class="btn btn-primary" type="submit">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">

                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>

                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>

                                        <path d="M21 21l-6 -6"></path>

                                    </svg>

                                </button>

                            </div>

                        </div>

                        <!-- Status -->
                        <div class="col-md-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status" class="form-select">

                                <option value="">
                                    All Status
                                </option>

                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                    Blocked
                                </option>

                            </select>

                        </div>

                        <!-- Gender -->
                        <div class="col-md-3">

                            <label class="form-label">
                                Gender
                            </label>

                            <select name="gender" class="form-select">

                                <option value="">
                                    All Gender
                                </option>

                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                            </select>

                        </div>

                        <!-- Button -->
                        <div class="col-md-1">

                            <button type="submit" class="btn btn-primary w-100">
                                Filter
                            </button>

                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Management</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($user->image) }}" alt="Brand Image"
                                            style="width: 70px; height: auto;">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender ?? "-" }}</td>
                                    <td>
                                        @if ($user->is_blocked)
                                            <span class="badge bg-danger-lt">blocked</span>
                                        @else
                                            <span class="badge bg-success-lt">active</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.users.edit', $user) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
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
