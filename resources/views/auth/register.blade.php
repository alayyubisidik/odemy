@extends('frontend.layouts.app')

@section('content')
    @php
        $activeTab = session('type', 'student');
    @endphp

    <section class="wsus__sign_in sign_up" style="margin-top: 150px; min-height: 120vh">
        <div class="row align-items-center" style="">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{ asset('assets/frontend/dist/images/login_img_2.jpg') }}" alt="login" class="img-fluid">
                    <a href="index.html">
                        <img src="{{ asset('assets/frontend/dist/images/logo.png') }}" alt="EduCore" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab == 'student' ? 'active' : '' }}" id="pills-home-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                aria-controls="pills-home" aria-selected="{{ $activeTab == 'student' ? 'true' : 'false' }}">
                                Student
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab == 'instructor' ? 'active' : '' }}" id="pills-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile"
                                aria-selected="{{ $activeTab == 'instructor' ? 'true' : 'false' }}">
                                Instructor
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade {{ $activeTab == 'student' ? 'show active' : '' }}" id="pills-home"
                            role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('register', ['type' => 'student']) }}" method="post">
                                @csrf

                                <h2>Student Sign Up</h2>
                                <p class="new_user">Already have an account? <a href="{{ route('login') }}">Sign In</a>
                                </p>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Name</label>
                                            <x-input-error :messages="$errors->get('name')" />
                                            <input name="name" type="text" placeholder="Your Name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email</label>
                                            <x-input-error :messages="$errors->get('email')" />
                                            <input name="email" type="email" placeholder="Your email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password</label>
                                            <x-input-error :messages="$errors->get('password')" />
                                            <input name="password" type="password" placeholder="Your password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Confirm Password</label>
                                            <x-input-error :messages="$errors->get('password_confirmation')" />
                                            <input name="password_confirmation" type="password" placeholder="Your password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p class="or">or</p>
                            <ul class="social_login d-flex flex-wrap">
                                <li>
                                    <a href="{{ route('login.google') }}" style="border-radius: 7px">
                                        <span><img src="{{ asset('assets/frontend/dist/images/google_icon.png') }}"
                                                alt="Google" class="img-fluid"></span>
                                        Google
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'instructor' ? 'show active' : '' }}" id="pills-profile"
                            role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

                            <form action="{{ route('register', ['type' => 'instructor']) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <h2>Instructor Sign Up</h2>
                                <p class="new_user">Already have an account? <a href="{{ route('login') }}">Sign
                                        In</a>
                                </p>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Name</label>
                                            <x-input-error :messages="$errors->get('name')" />
                                            <input name="name" type="text" placeholder="Your Name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email</label>
                                            <x-input-error :messages="$errors->get('email')" />
                                            <input name="email" type="email" placeholder="Your email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Document</label>
                                            <x-input-error :messages="$errors->get('document')" />
                                            <input name="document" type="file" placeholder="Your document"
                                                value="{{ old('document') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password</label>
                                            <x-input-error :messages="$errors->get('password')" />
                                            <input name="password" type="password" placeholder="Your password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Confirm Password</label>
                                            <x-input-error :messages="$errors->get('password_confirmation')" />
                                            <input name="password_confirmation" type="password"
                                                placeholder="Your password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p class="or">or</p>
                            <ul class="social_login d-flex flex-wrap">
                                <li>
                                    <a href="{{ route('login.google') }}" style="border-radius: 7px">
                                        <span><img src="{{ asset('assets/frontend/dist/images/google_icon.png') }}"
                                                alt="Google" class="img-fluid"></span>
                                        Google
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
