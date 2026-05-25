@extends('frontend.layouts.app')


@section('content')
    <x-breadcrumb title="About Us" />

    <section class="wsus__about_3 mt_120 xs_mt_100 ">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="wsus__about_3_img">

                        <img src="{{ $about?->image }}" alt="About us" class="about_3_large img-fluid w-100">

                        <div class="text">
                            <h4> <span>{{ $about?->lerner_count }}K+</span> {{ $about?->lerner_count_text }}</h4>
                            <img src="{{ asset($about?->lerner_image) }}" alt="Photo" class="img-fluid">
                        </div>

                        <div class="circle_box">
                            <svg viewBox="0 0 100 100">
                                <defs>
                                    <path id="circle2" d="
                                        M 50, 50
                                        m -37, 0
                                        a 37,37 0 1,1 74,0
                                        a 37,37 0 1,1 -74,0"></path>
                                </defs>
                                <text>
                                    <textPath xlink:href="#circle">
                                        take the worldwide best online course
                                    </textPath>
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="wsus__about_3_text">
                        <div class="wsus__section_heading heading_left mb_15">
                            <h5>Learn More About Us</h5>
                            <h2>{{ $about?->title }}</h2>
                        </div>
                        <p>{!! $about?->description !!}</p>
                        <a class="common_btn" style="margin-top: 50px"
                            href="{{ $about?->button_url }}">{{ $about?->button_text }}</a>
                        <div class="about_video" style="top: 250px">
                            <img src="{{ $about?->video_image }}" alt="Video" class="img-fluid w-100">
                            <span>live</span>
                            <a class="play_btn venobox" data-autoplay="true" data-vbtype="video"
                                href="{{ $about?->video_url }}">
                                <img src="{{ asset('assets/frontend/dist/images/play_icon.png') }}" alt="Play"
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--===========================
                        COUNTER START
                    ============================-->
    <section class="wsus__about_counter wsus__counter mt_120 xs_mt_100">
        <div class="container">
            <div class="wsus__counter_bg"
                style="background: url({{ asset('assets/frontend/dist/images/counter_bg.jpg') }});">
                <div class="row">
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_one }}</span></h2>
                            <p>{{ $counter?->title_one }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_two }}</span></h2>
                            <p>{{ $counter?->title_two }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_three }}</span></h2>
                            <p>{{ $counter?->title_three }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_four }}</span></h2>
                            <p>{{ $counter?->title_four }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        COUNTER END
                    ============================-->


    <!--===========================
                        TESTIMONIAL START
                    ============================-->
    <section class="wsus__testimonial pt_120 xs_pt_80" style="margin-bottom: 100px">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 m-auto wow fadeInUp">
                    <div class="wsus__section_heading mb_40">
                        <h5>Testimonial</h5>
                        <h2>Comments From Our Learners</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row testimonial_slider">
            @foreach ($testimonials as $testimonial)
                <div class="col-xl-4 wow fadeInUp">
                    <div class="wsus__single_testimonial">
                        <p class="rating">
                            @for ($i = 1; $i <= $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </p>
                        <p class="description">{{ $testimonial->review }}</p>
                        <div class="wsus__testimonial_footer">
                            <div class="img">
                                <img src="{{ $testimonial->user_image }}" alt="user" class="img-fluid">
                            </div>
                            <h3>
                                {{ $testimonial->user_name }}
                                <span>{{ $testimonial->user_title }}</span>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!--===========================
                        TESTIMONIAL END
                    ============================-->
@endsection
