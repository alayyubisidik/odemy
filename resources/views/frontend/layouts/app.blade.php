<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">
    @stack('meta')
    <title>EduCore - Online Courses & Education HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset(config('settings.site_favicon')) }}">


    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/scroll_button.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/pointer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/range_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/startRating.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/video_player.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/jquery.simple-bar-graph.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/sticky_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/jquery-ui.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.35.0/dist/tabler-icons.min.css" />




    @stack('style')


</head>

<body class="home_3">

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


    <script src="{{ asset('assets/frontend/dist/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/Font-Awesome.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/scroll_button.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/pointer.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/range_slider.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/animated_barfiller.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.calendar.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/starRating.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery.simple-bar-graph.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/video_player.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/video_player_youtube.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/main.js') }}"></script>
    <script src="{{ asset('assets/frontend/dist/js/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @include('frontend.layouts.script')
    @stack('script')

</body>

</html>
