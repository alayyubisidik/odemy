@extends('frontend.student.dashboard.dashboard-app')

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
                <a href="{{ route('student.profile.edit') }}" class="common_btn">
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

        </ul>
    </div>
@endsection
