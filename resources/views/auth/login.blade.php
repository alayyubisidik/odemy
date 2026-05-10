@extends('frontend.layouts.app')

@section('content')
    <section class="wsus__sign_in" style="margin-top: 90px">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{ asset('assets/frontend/dist/images/login_img_1.jpg') }}" alt="login" class="img-fluid">
                    <a href="index.html">
                        <img src="{{ asset('assets/frontend/dist/images/logo.png') }}" alt="EduCore" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('login') }}" method="post">
                                @csrf

                                <h2>Log in</h2>
                                <p class="new_user">New User ? <a href="{{ route('register') }}">Create an Account</a>
                                </p>

                                <x-auth-session-status :status="session('status')" />

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email*</label>
                                            <x-input-error :messages="$errors->get('email')" />
                                            <input name="email" type="text" placeholder="Email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password* <a href="{{ route('password.request') }}">Forgot
                                                    Password?</a></label>
                                            <x-input-error :messages="$errors->get('password')" />
                                            <input name="password" type="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Sign In</button>
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
        {{-- <a class="back_btn" href="index.html">Back to Home</a> --}}
    </section>
@endsection
