    @php
        $footer = App\Models\Footer::first();
        $socials = App\Models\SocialLink::where('status', 1)->get();
        $footerColumnOnes = App\Models\FooterColumnOne::where('status', 1)->get();
        $footerColumntwos = App\Models\FooterColumnTwo::where('status', 1)->get();
    @endphp

    <footer class="footer_3" style="background: url({{ asset(config('settings.site_footer_logo')) }});">
        <div class="footer_3_overlay pt_120 xs_pt_100">
            <div class="wsus__footer_bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 wow fadeInUp">
                            <div class="wsus__footer_3_logo_area">
                                <a class="logo" href="index.html">
                                    <img src="{{ asset('assets/frontend/dist/images/footer_logo.png') }}" alt="EduCore"
                                        class="img-fluid">
                                </a>
                                <p>{{ $footer?->description }}</p>
                                <h2>Follow Us On</h2>
                                <ul class="d-flex flex-wrap">
                                    @foreach ($socials as $social)
                                        <li>
                                            <a href="{{ $social->link }}" target="_blank">
                                                <img src="{{ asset($social->icon) }}"
                                                    style="width: 20px !important; height: 20px !important;"
                                                    alt="Social Icon">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                            <div class="wsus__footer_link">
                                <h2>Quick Links</h2>
                                <ul>
                                    @foreach ($footerColumnOnes as $item)
                                        <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                            <div class="wsus__footer_link">
                                <h2>Resources</h2>
                                <ul>
                                    @foreach ($footerColumntwos as $item)
                                        <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp">
                            <div class="wsus__footer_3_subscribe">
                                <h3>Subscribe Our Newsletter</h3>
                                <form action="#" method="post" class="newsletter-form">
                                    @csrf
                                    <input type="email" required name="email" placeholder="Enter Your Email">
                                    <button type="submit" class="common_btn">Subscribe</button>
                                </form>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="white" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                            </svg>
                                        </div>
                                        <div class="text">
                                            <h4>Email us:</h4>
                                            <a href="mailto:{{ $footer?->email }}">{{ $footer?->email }}</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/frontend/dist/images/call_icon_white.png') }}"
                                                alt="Call" class="img-fluid">
                                        </div>
                                        <div class="text">
                                            <h4>Call us:</h4>
                                            <a href="call-to:{{ $footer?->phone }}">{{ $footer?->phone }}</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/frontend/dist/images/location_icon_white.png') }}"
                                                alt="Call" class="img-fluid">
                                        </div>
                                        <div class="text">
                                            <h4>Office:</h4>
                                            <p>{{ $footer?->address }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wsus__footer_copyright_area mt_140 xs_mt_100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__footer_copyright_text">
                                <p>{{ $footer?->copyright }}</p>
                                <ul>
                                    <li><a href="http://odemy.test/page/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="http://odemy.test/page/terms-of-service">Term of Service</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
