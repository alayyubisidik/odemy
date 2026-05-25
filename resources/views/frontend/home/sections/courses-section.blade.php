@php
    $category_one = \App\Models\CourseCategory::find($latestCourses?->category_one);
    $category_two = \App\Models\CourseCategory::find($latestCourses?->category_two);
    $category_three = \App\Models\CourseCategory::find($latestCourses?->category_three);
    $category_four = \App\Models\CourseCategory::find($latestCourses?->category_four);
    $category_five = \App\Models\CourseCategory::find($latestCourses?->category_five);
@endphp

<section class="wsus__courses_3 pt_120 xs_pt_100 mt_120 xs_mt_90 pb_120 xs_pb_100">
    <div class="container">

        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp">
                <div class="wsus__section_heading mb_45">
                    <h5>Featured Courses</h5>
                    <h2>Latest Bundle Courses.</h2>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp">
            <div class="col-xxl-6 col-xl-8 m-auto">
                <div class="wsus__filter_area mb_15">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        @if ($category_one)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-{{ $category_one->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $category_one->id }}" type="button"
                                    role="tab" aria-controls="pills-{{ $category_one->id }}"
                                    aria-selected="true">{{ $category_one->name }}</button>
                            </li>
                        @endif
                        @if ($category_two)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-{{ $category_two->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category_two->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category_two->id }}"
                                    aria-selected="false">{{ $category_two->name }}</button>
                            </li>
                        @endif
                        @if ($category_three)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-{{ $category_three->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category_three->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category_three->id }}"
                                    aria-selected="false">{{ $category_three->name }}</button>
                            </li>
                        @endif
                        @if ($category_four)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-{{ $category_four->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category_four->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category_four->id }}"
                                    aria-selected="false">{{ $category_four->name }}</button>
                            </li>
                        @endif
                        @if ($category_five)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-{{ $category_five->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-{{ $category_five->id }}" type="button" role="tab"
                                    aria-controls="pills-{{ $category_five->id }}"
                                    aria-selected="false">{{ $category_five->name }}</button>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            @if ($category_one)
                <div class="tab-pane fade show active" id="pills-{{ $category_one->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $category_one->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($category_one->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">

                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ convertMinutesToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($course->reviews()->avg('rating'), 0) }}
                                                    Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons()->count() }} Lessons</li>
                                            <li>{{ $course->enrollments()->count() }} Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->image) }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" style="margin-bottom: 10px"
                                            data-course-id="{{ $course->id }}" href="#">Add To Cart <i
                                                class="far fa-arrow-right"></i></a>
                                        <p class="text-warning">
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($category_two)
                <div class="tab-pane fade show " id="pills-{{ $category_two->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $category_two->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($category_two->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">

                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ convertMinutesToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($course->reviews()->avg('rating'), 0) }}
                                                    Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons()->count() }} Lessons</li>
                                            <li>{{ $course->enrollments()->count() }} Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->image) }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" style="margin-bottom: 10px" data-course-id="{{ $course->id }}"
                                            href="#">Add To Cart <i class="far fa-arrow-right"></i></a>
                                        <p class="text-warning">
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($category_three)
                <div class="tab-pane fade show " id="pills-{{ $category_three->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $category_three->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($category_three->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">

                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ convertMinutesToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <p class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="fas fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($course->reviews()->avg('rating'), 2) }}
                                                    Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons()->count() }} Lessons</li>
                                            <li>{{ $course->enrollments()->count() }} Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->image) }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" style="margin-bottom: 10px" data-course-id="{{ $course->id }}"
                                            href="#">Add To Cart <i class="far fa-arrow-right"></i></a>
                                        <p class="text-warning">
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($category_four)
                <div class="tab-pane fade show " id="pills-{{ $category_four->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $category_four->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($category_four->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">

                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ convertMinutesToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($course->reviews()->avg('rating'), 0) }}
                                                    Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons()->count() }} Lessons</li>
                                            <li>{{ $course->enrollments()->count() }} Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->image) }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" style="margin-bottom: 10px" data-course-id="{{ $course->id }}"
                                            href="#">Add To Cart <i class="far fa-arrow-right"></i></a>
                                        <p class="text-warning">
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($category_five)
                <div class="tab-pane fade show " id="pills-{{ $category_five->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $category_five->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($category_five->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">

                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ convertMinutesToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($course->reviews()->avg('rating'), 0) }}
                                                    Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons()->count() }} Lessons</li>
                                            <li>{{ $course->enrollments()->count() }} Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->image) }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn add_to_cart" style="margin-bottom: 10px" data-course-id="{{ $course->id }}"
                                            href="#">Add To Cart <i class="far fa-arrow-right"></i></a>
                                        <p class="text-warning">
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            <div class="row mt_60 wow fadeInUp">
                <div class="col-12 text-center">
                    <a class="common_btn" href="{{ route('courses.index') }}">Browse More Courses <i
                            class="far fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
