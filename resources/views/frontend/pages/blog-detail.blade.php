@extends('frontend.layouts.app')

@push('meta')
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($blog->image) }}">
    <meta property="og:type" content="Blog">
@endpush

@section('content')
    <x-breadcrumb title="{{ $blog->title }}" />
    <section class="wsus__blog_details mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft">
                    <div class="wsus__blog_details_area">
                        <div class="wsus__blog_details_thumb">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100">
                        </div>

                        <div class="wsus__blog_details_header">
                            <ul class="d-flex flex-wrap">

                                <li>
                                    <span class="author">
                                        <img src="{{ asset($blog->user->image) }}" alt="user" class="img-fluid">
                                    </span>

                                    By {{ $blog->user->name }}
                                </li>

                                <li>
                                    <span>
                                        <img src="{{ asset('assets/frontend/dist/images/calendar_gray.png') }}"
                                            alt="calendar" class="img-fluid">
                                    </span>

                                    {{ $blog->created_at->format('F d, Y') }}
                                </li>

                                <li>
                                    <span>
                                        <img src="{{ asset('assets/frontend/dist/images/bookmark_icon.png') }}"
                                            alt="bookmark" class="img-fluid">
                                    </span>

                                    {{ $blog->blogCategory->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('assets/frontend/dist/images/comment_icon_gray.png') }}" alt="bookmark" class="img-fluid">
                                    </span>
                                    {{ $blog->comments()->count() }} Comments
                                </li>

                            </ul>

                            <h2>{{ $blog->title }}</h2>
                        </div>

                        <div class="wsus__blog_details_text">
                            {!! $blog->description !!}
                        </div>

                        <div class="wsus__blog_det_tags_share d-flex flex-wrap mt_50">

                            <ul class="share d-flex flex-wrap align-items-center">
                                <li><span>share:</span></li>

                                <li><a class="ez-facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="ez-linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a class="ez-x" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="ez-reddit" href="#"><i class="fab fa-reddit"></i></a></li>
                            </ul>

                        </div>
                        <div class="wsus__blog_det_author">
                            <div class="img">
                                <img src="{{ $blog->user->image }}" alt="Author" class="img-fluid">
                            </div>
                            <div class="text">
                                <h3>{{ $blog->user->name }}</h3>
                                <h5>Digital Marketing</h5>
                                <p>Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec pharetra rutrum sed
                                    allium lectus fermentum enim Nam maximus.</p>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wsus__blog_comment_area mt_75">
                            <h2>Comments</h2>
                            @foreach ($blog->comments ?? [] as $comment)
                                <div class="wsus__blog_single_comment">
                                    <div class="img">
                                        <img src="{{ asset($comment->user->image) }}" alt="Comments" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>{{ $comment->user->name }}</h4>
                                        <h6>
                                            {{ $comment->created_at->format('F d, Y \a\t h:i a') }}
                                            <a href="#"><i class="fas fa-reply"></i></a>
                                        </h6>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @auth
                            <div class="wsus__blog_comment_input_area mt_75">
                                <h2>Post a Comment</h2>
                                <p>Please add your comment here</p>
                                <form action="{{ route('blogs.comment.store', $blog->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <textarea name="comment" rows="5" placeholder="Leave a comment"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="common_btn">Post Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInRight">
                    <div class="wsus__blog_sidebar wsus__sidebar">
                        <form action="{{ route('blogs.index') }}" class="wsus__sidebar_search">
                            <input type="text" placeholder="Search Here..." name="search">
                            <button type="submit">
                                <img src="{{ asset('assets/frontend/dist/images/search_icon.png') }}" alt="Search"
                                    class="img-fluid">
                            </button>
                        </form>
                        <div class="wsus__sidebar_recent_post">
                            <h3>Recent Posts</h3>
                            <ul class="d-flex flex-wrap" style="">
                                @foreach ($recent_blogs as $recent_blog)
                                    <li style="display: flex; width: 100%;">
                                        <a href="{{ route('blogs.show', $recent_blog->slug) }}" class="img"
                                            style="background: red">
                                            <img src="{{ asset($recent_blog->image) }}" alt="Blog"
                                                class="img-fluid">
                                        </a>
                                        <div class="text" style="">
                                            <p>
                                                <span>
                                                    <img src="{{ asset('assets/frontend/dist/images/calendar_blue.png') }}"
                                                        alt="Clander" class="img-fluid">
                                                </span>
                                                {{ $recent_blog->created_at->format('F d, Y') }}
                                            </p>
                                            <a href="{{ route('blogs.show', $recent_blog->slug) }}"
                                                class="title">{{ $recent_blog->title }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_category">
                            <h3>Categories</h3>
                            <ul>
                                @foreach ($blog_categories as $blog_category)
                                    <li>
                                        <a href="{{ route('blogs.index', ['category' => $blog_category->slug]) }}">{{ $blog_category->name }}
                                            <span>({{ $blog_category->blogs_count }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>

    <script>
        $(function() {
            $('#starRating li').on('click', function() {
                var starRating = $('#starRating').find('.active').length;

                $('#rating').val(starRating);
            });
        });
    </script>
@endpush
