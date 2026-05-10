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
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf

                                <h2 class="mb-3">Forget Password<span></span></h2>
                                <p style="mb-3">Forgot your password? No problem. Just let us know your email
                                    address and we will email you a password
                                    reset link that will allow you to choose a new one.</p>

                                <p class="text-success" style="margin: 10px 0 5px;">{{ session('status') }}</p>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email*</label>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            <input name="email" type="text" placeholder="Email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Email Password Reset Link</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
