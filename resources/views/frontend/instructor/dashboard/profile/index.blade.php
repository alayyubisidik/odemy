@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    @php
        $user = user();
    @endphp

    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
            <div class="wsus__dashboard_heading">
                <h5>Instructor Profile</h5>
                <p>Manage your instructor profile information and approval status.</p>
            </div>

            <div class="wsus__dashboard_contant_btn">
                <a href="{{ route('instructor.profile.edit') }}" class="common_btn">
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="wsus__dashboard_profile">

            <div class="text ms-0">
                <h6>About Me</h6>

                <p>
                    {{ $user->bio ?: 'No bio available.' }}
                </p>
            </div>
        </div>

        <ul class="wsus__dashboard_profile_info">

            <li>
                <span>Name :</span>
                {{ $user->name }}
            </li>

            <li>
                <span>Email :</span>
                {{ $user->email }}
            </li>

            <li>
                <span>Headline :</span>
                {{ $user->headline ?: '-' }}
            </li>

            <li>
                <span>Gender :</span>
                {{ ucfirst($user->gender ?? '-') }}
            </li>

            <li>
                <span>Role :</span>
                {{ ucfirst($user->role) }}
            </li>

            <li>
                <span>Approval Status :</span>

                @if ($user->approve_status == 'approved')
                    <span class="badge bg-success">Approved</span>
                @elseif($user->approve_status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-danger">Rejected</span>
                @endif
            </li>

            <li>
                <span>Document :</span>

                @if ($user->document)
                    <a href="{{ asset($user->document) }}" target="_blank">
                        View Document
                    </a>
                @else
                    No document uploaded
                @endif
            </li>

            <li>
                <span>Facebook :</span>

                @if ($user->facebook)
                    <a href="{{ $user->facebook }}" target="_blank">
                        Facebook Profile
                    </a>
                @else
                    -
                @endif
            </li>

            <li>
                <span>Github :</span>

                @if ($user->github)
                    <a href="{{ $user->github }}" target="_blank">
                        Github Profile
                    </a>
                @else
                    -
                @endif
            </li>

            <li>
                <span>LinkedIn :</span>

                @if ($user->linkedin)
                    <a href="{{ $user->linkedin }}" target="_blank">
                        LinkedIn Profile
                    </a>
                @else
                    -
                @endif
            </li>

            <li>
                <span>Website :</span>

                @if ($user->website)
                    <a href="{{ $user->website }}" target="_blank">
                        Personal Website
                    </a>
                @else
                    -
                @endif
            </li>

            <li>
                <span>Joined At :</span>
                {{ $user->created_at->format('d M Y') }}
            </li>

        </ul>
    </div>
@endsection
