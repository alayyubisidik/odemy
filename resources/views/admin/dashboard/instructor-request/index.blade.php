@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh; ">

        <h2 class="page-title" style="margin-bottom: 30px">
            Instructor Request Management
        </h2>

        {{-- <div class="card" style="margin-bottom: 10px">
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
        </div> --}}

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Instructor Request List</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($instructor_requests as $instructor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $instructor->name }}</td>
                                    <td class="text-secondary">{{ $instructor->email }}</td>
                                    <td>
                                        @if ($instructor->approve_status == 'pending')
                                            <span class="badge bg-warning-lt">Pending</span>
                                        @elseif ($instructor->approve_status == 'approved')
                                            <span class="badge bg-success-lt">Approved</span>
                                        @else
                                            <span class="badge bg-danger-lt">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.instructor-requests.download', $instructor) }}"
                                            class="text-primary" title="Download">
                                            <i class="ti ti-download" style="cursor: pointer"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <form action="{{ route('admin.instructor-requests.update-status', $instructor) }}"
                                            method="POST">
                                            @csrf
                                            <select name="approve_status" class="form-select" onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $instructor->approve_status == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="approved"
                                                    {{ $instructor->approve_status == 'approved' ? 'selected' : '' }}>
                                                    Approved
                                                </option>
                                                <option value="rejected"
                                                    {{ $instructor->approve_status == 'rejected' ? 'selected' : '' }}>
                                                    Rejected
                                                </option>
                                            </select>
                                        </form>
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
                    {{ $instructor_requests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
