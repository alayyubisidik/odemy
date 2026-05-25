@php

    $notifications = \App\Models\Notification::where('user_id', user()->id)
        ->orderByRaw('read_at IS NULL DESC')
        ->latest()
        ->take(10)
        ->get();

    $unreadNotifications = \App\Models\Notification::where('user_id', user()->id)->whereNull('read_at')->count();

@endphp

<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">

                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>

                        @if ($unreadNotifications > 0)
                            <span class="badge bg-red"><span
                                    style="color: white">{{ $unreadNotifications }}</span></span>
                        @endif

                    </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card"
                        style="width: 350px;">

                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center">

                                <h3 class="card-title mb-0">Notifications</h3>

                                @if ($notifications->count() > 0)
                                    <form action="{{ route('admin.notifications.delete-all') }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <a href="#" class="text-danger delete-btn">

                                            <i class="ti ti-trash"></i>

                                        </a>

                                    </form>
                                @endif

                            </div>

                            <div class="list-group list-group-flush list-group-hoverable">

                                @forelse ($notifications as $notification)
                                    <a href="{{ route('admin.notifications.read', $notification->id) }}"
                                        class="list-group-item">

                                        <div class="row align-items-center">

                                            <div class="col-auto">

                                                @if (is_null($notification->read_at))
                                                    <span
                                                        class="status-dot status-dot-animated bg-{{ $notification->color ?? 'blue' }} d-block">
                                                    </span>
                                                @endif

                                            </div>

                                            <div class="col text-truncate">

                                                <div class="text-body d-block">
                                                    {{ $notification->title }}
                                                </div>

                                                <div class="d-block text-secondary text-truncate mt-n1">
                                                    {{ $notification->message }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </small>

                                            </div>

                                        </div>

                                    </a>

                                @empty

                                    <div class="list-group-item text-center text-muted py-4">
                                        No notifications found
                                    </div>
                                @endforelse

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 " data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ asset(user()->image) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ user()->name }}</div>
                        <div class="mt-1 small text-secondary">{{ user()->role }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow dropdown-profile">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="#" onclick="confirmLogout(event)" class="dropdown-item">
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">

        </div>
    </div>
</header>
