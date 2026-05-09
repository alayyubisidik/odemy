<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Odemy | Admin Dashboard </title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!-- CSS files -->
    <link href="{{ asset('assets/backend/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/demo.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.35.0/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    @include('admin.dashboard.layouts.style')

</head>

<body>
    <script src="{{ asset('assets/backend/dist/js/demo-theme.min.js') }}"></script>
    <div class="page">

        @include('admin.dashboard.layouts.sidebar')
        @include('admin.dashboard.layouts.header')

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="page-body">
                    @yield('content')
                </div>
            </div>

            @include('admin.dashboard.layouts.footer')
        </div>
    </div>


    <!-- Tabler Core -->
    <script src="{{ asset('assets/backend/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/backend/dist/js/demo.min.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/backend/backend/dist/libs/litepicker/dist/litepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script')

    @include('admin.dashboard.layouts.script')

</body>

</html>
