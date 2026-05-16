<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>EduCore - Online Courses & Education HTML Template</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
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
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/dist/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">


    <style>
        .form-check-label.lesson.active {
            color: #356df1;
            font-weight: 600;
        }
    </style>


</head>

<body class="home_3">



    <!--============ PRELOADER START ===========-->


    <!--===========================
        COURSE VIDEO START
    ============================-->
    <section class="wsus__course_video">
        <div class="col-12">
            <div class="wsus__course_header">
                <a href="{{ route('student.my-learning.index') }}"><i class="fas fa-angle-left"></i>Go Back</a>
                <p>Your Progress: {{ count($wathedLessonIds) }} of {{ $lessonCount }}
                    ({{ $lessonCount > 0 ? round((count($wathedLessonIds) / $lessonCount) * 100) : 0 }}%)</p>
            </div>
        </div>

        <div class="wsus__course_video_player">

            <!-- <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                poster="images/video_thumb.jpg" data-setup="{}">
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/webm" />
            </video> -->

            <div class="video_holder">

            </div>

            <div class="video_tabs_area">
                <ul class="nav nav-pills" id="pills-tab2" role="tablist">
                    <li class="nav-item d-lg-none" role="presentation">
                        <button class="nav-link" id="pills-home-tab2" data-bs-toggle="pill"
                            data-bs-target="#pills-home2" type="button" role="tab" aria-controls="pills-home2"
                            aria-selected="true">Course Content</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-disabled" type="button" role="tab"
                            aria-controls="pills-disabled" aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade d-lg-none" id="pills-home2" role="tabpanel"
                        aria-labelledby="pills-home-tab2" tabindex="0">
                        <div class="video_course_content">
                            <div class="wsus__course_sidebar">
                                <h2 class="video_heading">Course Content</h2>
                                <div class="accordion" id="accordionExample">
                                    @foreach ($course->chapters as $chapter)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne4409"
                                                    aria-expanded="true" aria-controls="collapseOne4409">
                                                    <b>Introduction</b>
                                                    <span>5/5</span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne4409" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="">
                                                        <label class="form-check-label">
                                                            1_Setting up Environment (Part - 1)
                                                            <span>
                                                                <img src="images/video_icon_black_2.png"
                                                                    alt="video" class="img-fluid">
                                                                06.03
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="">
                                                        <label class="form-check-label">
                                                            2_Environment Setup for Project (Part - 1)
                                                            <span>
                                                                <img src="images/video_icon_black_2.png"
                                                                    alt="video" class="img-fluid">
                                                                06.03
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="video_about">
                            <h1>About this lecture</h1>
                            <p class="short_description about_lecture"></p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>By the numbers</p>
                                            </td>
                                            <td>
                                                <p>Skill level: All Levels </p>
                                                <p>Students: 53</p>
                                                <p>Languages: English</p>
                                                <p>Captions: Yes</p>
                                            </td>
                                            <td>
                                                <p>Lectures: 44</p>
                                                <p>Video: 6.5 total hours</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>Description</p>
                                            </td>
                                            <td>
                                                <p>You know the latest laravel version is now Laravel 9. So we have
                                                    created a very complete course on Laravel 9.</p>
                                                <p>If you are new to Laravel or beginner to Laravel, you will be able to
                                                    learn it in advanced level from this course.</p>
                                                <p><b>Here we have taught the students:</b></p>
                                                <ul>
                                                    <li>Composer - Installing composer in local machine.</li>
                                                    <li>MVC (Model, View, Controller) - How it works and details. </li>
                                                    <li>Laravel 9 Installation - Installation process,</li>
                                                    <li>Route - Basic route, route parameter, route group</li>
                                                    <li>Middleware - How it works, types of middleware</li>
                                                    <li>Controller - Basic controller, partial and resource</li>
                                                    <li>View - view features (extends, include, yield, section)</li>
                                                </ul>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="pills-disabled" role="tabpanel"
                        aria-labelledby="pills-disabled-tab" tabindex="0">
                        <div class="video_review">
                            <h2>Reviews (09)</h2>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>


                            <div class="video_review_imput">
                                <h2>Write a reviews</h2>
                                <p>
                                    <span>select rating:</span>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </p>
                                <form action="#">
                                    <textarea name="" id="" cols="30" rows="5" placeholder="Youe coment..."></textarea>
                                    <button type="submit" class="btn arrow-btn back_qna_list">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="wsus__course_sidebar d-none d-lg-block">
            <h2 class="video_heading">Course Content</h2>
            <div class="accordion" id="accordionExample">
                @foreach ($course->chapters as $chapter)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $chapter->id }}">
                                <b>{{ $chapter->title }}</b>
                                <span>5/5</span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse "
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($chapter->lessons as $lesson)
                                    <div class="form-check ">
                                        <input class="form-check-input make_completed" @checked(in_array($lesson->id, $wathedLessonIds))
                                            data-course-id="{{ $course->id }}"
                                            data-lesson-id="{{ $lesson->id }}"
                                            data-chapter-id="{{ $chapter->id }}" type="checkbox" value="">
                                        <label class="form-check-label lesson" data-course-id="{{ $course->id }}"
                                            data-lesson-id="{{ $lesson->id }}"
                                            data-chapter-id="{{ $chapter->id }}">
                                            {{ $lesson->title }}
                                            <span>
                                                <img src="{{ asset('assets/frontend/dist/images/video_icon_black_2.png') }}"
                                                    alt="video" class="img-fluid">
                                                {{ convertMinutesToHours($lesson->duration) }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--===========================
        COURSE VIDEO END
    ============================-->




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
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>



    <script>
        var notyf = new Notyf({
            duration: 3000
        });

        function playerHtml(source_type, source) {
            if (source_type == 'youtube') {
                let player = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                    data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "${source}" }] }'>
                </video>`;

                return player;
            } else if (source_type == 'upload' || source_type == 'external_link') {
                let player =
                    `<video controls autoplay style="width:100%; height:100%; min-height: 40vh">
                        <source src="${source}" type="video/mp4">
                    </video>`;

                return player;
            }
        }

        function updateWatchHistory(courseId, chapterId, lessonId) {

            $.ajax({
                method: 'POST',
                url: "{{ route('student.update-watch-history') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'chapter_id': chapterId,
                    'lesson_id': lessonId,
                    'course_id': courseId
                },
                beforeSend: function() {},
                success: function(data) {

                },
                error: function(xhr, status, error) {}
            })
        }

        $('.lesson').on('click', function() {

            $('.lesson').removeClass('active');
            $(this).addClass('active');

            let chapterId = $(this).data('chapter-id');
            let lessonId = $(this).data('lesson-id');
            let courseId = $(this).data('course-id');

            $.ajax({
                method: 'GET',
                url: "{{ route('student.get-lesson-content') }}",
                data: {
                    'chapter_id': chapterId,
                    'lesson_id': lessonId,
                    'course_id': courseId
                },
                beforeSend: function() {},
                success: function(data) {
                    $('.video_holder').html(playerHtml(data.storage, data.file_path));

                    $('.about_lecture').text(data.description);

                    // resetting any existing player
                    if (videojs.getPlayers()["vid1"]) {
                        videojs.getPlayers()["vid1"].dispose();
                    }

                    // initializing the player
                    if ($('#vid1').length > 0) {
                        videojs("vid1").ready(function() {
                            this.play();
                        });
                    }

                    updateWatchHistory(courseId, chapterId, lessonId)
                },
                error: function(xhr, status, error) {}
            })

        });

        $('.make_completed').on('click', function() {

            let chapterId = $(this).data('chapter-id');
            let lessonId = $(this).data('lesson-id');
            let courseId = $(this).data('course-id');

            $.ajax({
                method: 'POST',
                url: "{{ route('student.update-lesson-completion') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'chapter_id': chapterId,
                    'lesson_id': lessonId,
                    'course_id': courseId
                },
                beforeSend: function() {},
                success: function(data) {
                    notyf.success(data.message);
                },
                error: function(xhr, status, error) {}
            })

        });


        $(function() {

            let lastWatchHistory = @json($lastWatchHistory);

            let lessons = $('.lesson');

            if (lastWatchHistory) {

                $.each(lessons, function(index, lesson) {

                    let chapterId = $(lesson).data('chapter-id');
                    let courseId = $(lesson).data('course-id');
                    let lessonId = $(lesson).data('lesson-id');

                    if (
                        chapterId == lastWatchHistory.chapter_id &&
                        courseId == lastWatchHistory.course_id &&
                        lessonId == lastWatchHistory.lesson_id
                    ) {

                        $(lesson).click();

                        $(lesson).addClass('active');

                        $(lesson).closest('.accordion-collapse').addClass('show');
                    }
                });

            } else {

                $('.lesson').first().click();
            }

        });
    </script>

</body>

</html>
