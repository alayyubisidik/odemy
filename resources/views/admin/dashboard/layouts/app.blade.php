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

    <script src="{{ asset('assets/backend/dist/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        // Konfigurasi untuk textarea#editor (Tinggi 500)
        tinymce.init({
            selector: 'textarea#editor',
            height: 500,
            license_key: 'gpl',

            // --- Bagian yang ditambahkan/diubah: ---
            plugins: 'lists advlist autolink link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                              alignleft aligncenter alignright alignjustify | \
                              bullist numlist | removeformat | help'
            // -------------------------------------
        });

        // Konfigurasi untuk textarea#short-editor (Tinggi 300)
        tinymce.init({
            selector: 'textarea#short-editor',
            height: 300,
            license_key: 'gpl',

            // --- Bagian yang ditambahkan/diubah: ---
            plugins: 'lists advlist autolink link image charmap wordcount',
            toolbar: 'undo redo | bold italic | bullist numlist'
            // -------------------------------------
        });

        tinymce.init({
            selector: 'textarea#big-editor',
            height: 1000,
            license_key: 'gpl',

            // --- Bagian yang ditambahkan/diubah: ---
            plugins: 'lists advlist autolink link image charmap wordcount',
            toolbar: 'undo redo | bold italic | bullist numlist'
            // -------------------------------------
        });
    </script>

    @stack('styles')

</head>

<body>
    <script src="{{ asset('assets/backend/dist/js/demo-theme.min.js') }}"></script>
    <div class="page">

        @include('admin.dashboard.layouts.sidebar')
        @include('admin.dashboard.layouts.header')

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header">
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


    @stack('script')

    @include('admin.dashboard.layouts.script')

</body>

</html>
