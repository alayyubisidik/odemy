@extends('frontend.layouts.app')


@section('content')
    <x-breadcrumb title="Blog" />

    <!--===========================
                                    BREADCRUMB END
                                ============================-->


    <!--===========================
                                    CART VIEW START
                                ============================-->
    <section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="wsus__single_blog_4">

                            <a href="#" class="wsus__single_blog_4_img">
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">

                                <span class="date">
                                    {{ $blog->created_at->format('F d, Y') }}
                                </span>
                            </a>

                            <div class="wsus__single_blog_4_text">

                                <ul>
                                    <li>
                                        <span>
                                            <img src="{{ asset('assets/frontend/dist/images/user_icon_black.png') }}" alt="User"
                                                class="img-fluid">
                                        </span>

                                        By {{ $blog->user->name }}
                                    </li>

                                    <li>
                                        <span>
                                            <img src="{{ asset('assets/frontend/dist/images/comment_icon_black.png') }}" alt="Comment"
                                                class="img-fluid">
                                        </span>

                                        {{ $blog->blogCategory->name }}
                                    </li>
                                </ul>

                                <a href="#" class="title">
                                    {{ $blog->title }}
                                </a>

                                <p>
                                    {{ Str::limit(strip_tags($blog->description), 100) }}
                                </p>

                                <a href="{{ route('blogs.show', $blog->slug) }}" class="common_btn">
                                    Read More <i class="far fa-arrow-right"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No blogs available.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>


    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>
@endpush
