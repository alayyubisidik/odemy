@extends('frontend.layouts.app')

@section('content')
    <x-breadcrumb title="Course" />

    <!--===========================
                                            BREADCRUMB END
                                        ============================-->


    <!--===========================
                                            COURSES PAGE START
                                        ============================-->
    <section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft">
                    <div class="wsus__sidebar">
                        <form action="{{ route('courses.index') }}">
                            <div class="wsus__sidebar_search">
                                <input type="text" name="search" placeholder="Search Course" value="{{ request('search') ?? '' }}">
                                <button type="submit">
                                    <img src="{{ asset('assets/frontend/dist/images/search_icon.png') }}" alt="Search"
                                        class="img-fluid">
                                </button>
                            </div>

                            <div class="wsus__sidebar_category">
                                <h3>Categories</h3>
                                <ul class="categoty_list">
                                    @foreach ($categories as $category)
                                        <li class="active">{{ $category->name }}
                                            <div class="wsus__sidebar_sub_category">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="category[]" value="{{ $subCategory->id }}"
                                                            id="category-{{ $subCategory->id }}" name="{{ $subCategory->id }}" @checked(
                                                                is_array(request('category')) ?
                                                                in_array($subCategory->id, request('category', [])) : request('category') == $subCategory->id
                                                            )>
                                                        <label class="form-check-label" for="category-{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="wsus__sidebar_course_lavel">
                                <h3>Difficulty Level</h3>
                                @foreach ($levels as $level)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="level-{{ $level->id }}" name="level[]" value="{{ $level->id }}" @checked(in_array($level->id, request('level', [])))>
                                        <label class="form-check-label" for="level-{{ $level->id }}">
                                            {{ $level->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
{{--
                            <div class="wsus__sidebar_course_lavel rating">
                                <h3>Rating</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr1">
                                    <label class="form-check-label" for="flexCheckDefaultr1">
                                        <i class="fas fa-star"></i> 5 star
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr2">
                                    <label class="form-check-label" for="flexCheckDefaultr2">
                                        <i class="fas fa-star"></i> 4 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr3">
                                    <label class="form-check-label" for="flexCheckDefaultr3">
                                        <i class="fas fa-star"></i> 3 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr4">
                                    <label class="form-check-label" for="flexCheckDefaultr4">
                                        <i class="fas fa-star"></i> 2 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr5">
                                    <label class="form-check-label" for="flexCheckDefaultr5">
                                        <i class="fas fa-star"></i> 1 star or above
                                    </label>
                                </div>
                            </div> --}}

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Language</h3>
                                @foreach ($languages as $language)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $language->id }}" @checked(in_array($language->id, request('language', []))) name="language[]" id="language-{{ $language->id }}">
                                        <label class="form-check-label" for="language-{{ $language->id }}">
                                            {{ $language->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                            <br>
                            <br>

                            <div class="row">
                                <button type="submit" class="common_btn">Apply Filters</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-lg-1">
                    <div class="wsus__page_courses_header wow fadeInUp">
                        <p>Showing <span>1-{{ $courses->count() }}</span> Of <span>{{ $courses->total() }}</span> Results
                        </p>
                        <form action="{{ route('courses.index', request()->all()) }}">
                            <p>Sort-by:</p>
                            <select class="select_js" name="order" onchange="this.form.submit()">
                                <option value="desc" @selected(request()->order == 'desc')>New to Old</option>
                                <option value="asc" @selected(request()->order == 'asc')>Old to New</option>
                            </select>
                        </form>
                    </div>
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-xl-4 col-md-6 wow fadeInUp">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a class="cursor-pointer" href="{{ route('courses.show', $course->slug) }}">
                                                    <img src="{{ asset('assets/frontend/dist/images/love_icon_black.png') }}"
                                                        alt="Love" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('assets/frontend/dist/images/compare_icon_black.png') }}"
                                                        alt="Compare" class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('assets/frontend/dist/images/cart_icon_black_2.png') }}"
                                                        alt="Cart" class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i> {{ convertMinutesToHours($course->duration) }}</span>
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
                                              <p class="text-warning" >
                                            @if ($course->price == 0)
                                                FREE
                                            @elseif($course->discount > 0)
                                                <del>{{ rupiah($course->price) }}</del> {{ rupiah($course->discount) }}
                                            @else
                                                {{ rupiah($course->price) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <center>
                                <p>No Course Available</p>
                            </center>
                        @endforelse
                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp">
                        {{ $courses->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function addToCart(courseId) {
            $.ajax({
                url: "{{ route('cart.add', ':id') }}".replace(':id', courseId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },

                success: function(data) {
                    notyf.success(data.message);

                    // update cart count tanpa refresh
                    $('#cart-count').text(data.cartCount);
                },

                error: function(xhr, status, error) {
                    console.log(xhr);

                    let errorMessage = xhr.responseJSON.message;
                    notyf.error(errorMessage);
                }
            });
        }
        $(function() {
            /** add course into cart */
            $('.add_to_cart').on('click', function(e) {
                e.preventDefault();

                let courseId = $(this).data('course-id');
                addToCart(courseId);
            })
        });
    </script>
@endpush
