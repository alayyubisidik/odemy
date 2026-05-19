 <!--===========================
        HEADER START
    ============================-->

 @php
     $topBar = \App\Models\TopBar::first();
     $categories = \App\Models\CourseCategory::where('is_active', 1)->where('parent_id', null)->get();
     $custom_pages = \App\Models\CustomPage::where('status', 1)->get();
 @endphp

 <header class="header_3">
     <div class="row">
         <div class="col-xxl-4 col-lg-7 col-md-8 d-none d-md-block">
             <ul class="wsus__header_left d-flex flex-wrap">
                 <li><a href="mailto:{{ $topBar->email }}"><i class="fab fa-envelope"></i>{{ $topBar->email }}</a></li>
                 <li><a href="callto:{{ $topBar->phone }}"><i class="fas fa-phone-alt"></i> {{ $topBar->phone }}</a></li>
             </ul>
         </div>
         <div class="col-xxl-5 col-lg-7 d-none d-xxl-block">
             <div class="wsus__header_center">
                 <p> <span>{{ $topBar->offer_name }}</span> {{ $topBar->offer_short_description }} <a
                         href="{{ $topBar->offer_button_url }}">{{ $topBar->offer_button_text }}</a></p>
             </div>
         </div>

     </div>
 </header>
 <!--===========================
        HEADER END
    ============================-->


 <!--===========================
        MAIN MENU 3 START
    ============================-->
 <nav class="navbar navbar-expand-lg main_menu main_menu_3">
     <a class="navbar-brand" href="/">
         <img src="{{ asset(config('settings.site_logo')) }}" alt="EduCore" class="img-fluid">
     </a>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="menu_category">
             <div class="icon">
                 <img src="{{ asset('assets/frontend/dist/images/grid_icon.png') }}" alt="Category" class="img-fluid">
             </div>
             Category
             <ul>
                 @foreach ($categories as $category)
                     <li>
                         <a href="javascript:void(0)">
                             <span>
                                 <img src="{{ asset($category->icon) }}" alt="Category" class="img-fluid">
                             </span>
                             {{ $category->name }}
                         </a>
                         @if ($category->subCategories->count() > 0)
                             <ul class="category_sub_menu">
                                 @foreach ($category->subCategories as $subCategory)
                                     <li><a
                                             href="{{ route('courses.index', ['category' => $subCategory->id]) }}">{{ $subCategory->name }}</a>
                                     </li>
                                 @endforeach
                             </ul>
                         @endif
                     </li>
                 @endforeach
             </ul>
         </div>
         <ul class="navbar-nav m-auto">
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Home</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('about-us.index') ? 'active' : '' }}"
                     href="{{ route('about-us.index') }}">About Us</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}"
                     href="{{ route('courses.index') }}">Courses</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}"
                     href="{{ route('contact.index') }}">Contact Us</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#">pages <i class="far fa-angle-down"></i></a>
                 <ul class="droap_menu">
                     <li>
                         <a class="" href="{{ route('blogs.index') }}">
                             Blog
                         </a>
                     </li>
                     @foreach ($custom_pages as $page)
                         <li>
                             <a class="" href="{{ route('custom-pages', $page->slug) }}">
                                 {{ $page->title }}
                             </a>
                         </li>
                     @endforeach
                 </ul>
             </li>

         </ul>

         <div class="right_menu">
             <div class="menu_search_btn" style="margin-right: 10px">
                 <img src="{{ asset('assets/frontend/dist/images/search_icon.png') }}" alt="Search"
                     class="img-fluid">
             </div>
             <ul>
                 @auth
                     <li>
                         <a class="menu_signin" href="{{ route('cart.index') }}">
                             <span>
                                 <img src="{{ asset('assets/frontend/dist/images/cart_icon_black.png') }}" alt="user"
                                     class="img-fluid">
                             </span>
                             <b id="cart-count">{{ cartCount() }}</b>
                         </a>
                     </li>
                     @if (user()->role == 'student')
                         <li>
                             <a class="admin" href="{{ route('student.dashboard.index') }}">
                                 <span>
                                     <img src="{{ asset('assets/frontend/dist/images/user_icon_black.png') }}"
                                         alt="user" class="img-fluid">
                                 </span>
                                 {{ user()->name }}
                             </a>
                         </li>
                     @elseif (user()->role == 'instructor')
                         <li>
                             <a class="admin" href="{{ route('instructor.dashboard.index') }}">
                                 <span>
                                     <img src="{{ asset('assets/frontend/dist/images/user_icon_black.png') }}"
                                         alt="user" class="img-fluid">
                                 </span>
                                 {{ user()->name }}
                             </a>
                         </li>
                     @else
                         <li>
                             <a class="admin" href="{{ route('admin.dashboard.index') }}">
                                 <span>
                                     <img src="{{ asset('assets/frontend/dist/images/user_icon_black.png') }}"
                                         alt="user" class="img-fluid">
                                 </span>
                                 {{ user()->name }}
                             </a>
                         </li>
                     @endif
                 @else
                     <li>
                         <a class="common_btn" href="{{ route('login') }}">Sign In</a>
                     </li>

                 @endauth
             </ul>
         </div>


     </div>
 </nav>
 <div class="wsus__menu_3_search_area">
     <form action="{{ route('courses.index') }}">
         <input type="text" placeholder="Search School, Online....." name="search">
         <button class="common_btn" type="submit">Search</button>
         <span class="close_search"><i class="far fa-times"></i></span>
     </form>
 </div>
 <!--===========================
        MAIN MENU 3 END
    ============================-->


 <!--============================
        STICKY MENU START
    ==============================-->
 <div class="mobile_menu_area">
     <div class="mobile_menu_area_top">
         <a class="mobile_menu_logo" href="index.html">
             <img src="{{ asset(config('settings.site_logo')) }}" style="width: 125px !important" alt="EduCore">
         </a>
         <div class="mobile_menu_icon d-block d-lg-none" data-bs-toggle="offcanvas"
             data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
             <span class="mobile_menu_icon"><i class="far fa-stream menu_icon_bar"></i></span>
         </div>
     </div>

     <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
         <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                 class="fal fa-times"></i></button>
         <div class="offcanvas-body">

             @auth
                 <ul class="mobile_menu_header d-flex flex-wrap">
                     <li><a href="{{ route('cart.index') }}"><i class="far fa-shopping-basket"></i>
                             <span id="cart-count">{{ cartCount() }}</span></a>
                     </li>

                     @if (user()->role == 'student')
                         <li><a href="{{ route('student.dashboard.index') }}"><i class="far fa-user"></i></a></li>
                     @elseif (user()->role == 'instructor')
                         <li><a href="{{ route('instructor.dashboard.index') }}"><i class="far fa-user"></i></a></li>
                     @else
                         <li><a href="{{ route('admin.dashboard.index') }}"><i class="far fa-user"></i></a></li>
                     @endif

                 </ul>
             @else
                 <a href="{{ route('login') }}" class="common_btn">Sign In</a>

             @endauth


             <form class="mobile_menu_search" action="{{ route('courses.index') }}">
                 <input type="text" placeholder="Search" name="search">
                 <button type="submit"><i class="far fa-search"></i></button>
             </form>

             <div class="mobile_menu_item_area">
                 <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                         <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                             aria-selected="true">menu</button>
                         <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                             aria-selected="false">Categories</button>
                     </div>
                 </nav>
                 <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                         aria-labelledby="nav-home-tab" tabindex="0">
                         <ul class="main_mobile_menu">
                             <li class="">
                                 <a href="{{ route('index') }}">Home</a>
                             </li>
                             <li class="">
                                 <a href="{{ route('about-us.index') }}">About Us</a>
                             </li>
                             <li class="">
                                 <a href="{{ route('contact.index') }}">Contact Us</a>
                             </li>
                             <li class="">
                                 <a href="{{ route('blogs.index') }}">Blog</a>
                             </li>
                             <li class="mobile_dropdown">
                                 <a href="#">pages</a>
                                 <ul class="inner_menu">
                                     @foreach ($custom_pages as $page)
                                         <li>
                                             <a class="" href="{{ route('custom-pages', $page->slug) }}">
                                                 {{ $page->title }}
                                             </a>
                                         </li>
                                     @endforeach
                                 </ul>
                             </li>

                         </ul>
                     </div>
                     <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                         tabindex="0">
                         <ul class="main_mobile_menu">

                             @foreach ($categories as $category)
                                 <li class="mobile_dropdown">

                                     <a href="javascript:void(0)">

                                         <span>
                                             <img src="{{ asset($category->icon) }}" alt="Category"
                                                 class="img-fluid">
                                         </span>

                                         {{ $category->name }}

                                     </a>

                                     @if ($category->subCategories->count() > 0)
                                         <ul class="inner_menu">

                                             @foreach ($category->subCategories as $subCategory)
                                                 <li>
                                                     <a
                                                         href="{{ route('courses.index', ['category' => $subCategory->id]) }}">
                                                         {{ $subCategory->name }}
                                                     </a>
                                                 </li>
                                             @endforeach

                                         </ul>
                                     @endif

                                 </li>
                             @endforeach

                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--============================
b        STICKY MENU END
    ==============================-->
