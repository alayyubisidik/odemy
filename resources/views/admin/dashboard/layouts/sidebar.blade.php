<aside class="navbar navbar-vertical navbar-expand-lg d-print-none" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex gap-3 pt-3 px-3 pb-3 pb-lg-0" style="justify-content: center">
            <a href="{{ route('index') }}">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" width="125">
            </a>
        </div>

        <div class="navbar-nav flex-row d-lg-none">

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset('assets/backend/dist/static/avatars/000m.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Paweł Kuna</div>
                        <div class="mt-1 small text-secondary">UI Designer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="./sign-in.html" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3 sidebar-menu">
                <li class="nav-item  {{ setActive(['admin.dashboard.index*'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.users.*'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            User
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.orders.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Orders</span>
                    </a>
                </li>


                <li class="nav-item {{ setActive(['admin.instructor-requests.*'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.instructor-requests.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Instructor Request
                        </span>
                    </a>
                </li>

                <li
                    class="nav-item dropdown {{ setActive(['admin.course-languages.*', 'admin.course-levels.*', 'admin.course-categories.*', 'admin.course-sub-categories.*', 'admin.courses.*', 'admin.reviews.*'], 'active') }}">

                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                                <path
                                    d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Course Management</span>
                    </a>
                    <div
                        class="dropdown-menu {{ setActive(['admin.course-languages.*', 'admin.course-levels.*', 'admin.course-categories.*', 'admin.course-sub-categories.*', 'admin.courses.*', 'admin.reviews.*'], 'show') }}">

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.courses.*']) }}"
                                    href="{{ route('admin.courses.index') }}">
                                    Courses
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.course-categories.*']) }}"
                                    href="{{ route('admin.course-categories.index') }}">
                                    Course Category
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.course-languages.*']) }}"
                                    href="{{ route('admin.course-languages.index') }}">
                                    Course Language
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.course-levels.*']) }}"
                                    href="{{ route('admin.course-levels.index') }}">
                                    Course Level
                                </a>
                            </div>
                        </div>

                        {{-- <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.reviews.*']) }}"
                                    href="{{ route('admin.reviews.index') }}">
                                    Course Review
                                </a>
                            </div>
                        </div> --}}

                    </div>

                </li>


                <li
                    class="nav-item dropdown {{ setActive(['admin.top-bars.*', 'admin.footers.*', 'admin.social-links.*', 'admin.footer-column-one.*', 'admin.footer-column-two.*'], 'active') }}">

                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                                <path
                                    d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Header and Footer</span>
                    </a>

                    <div
                        class="dropdown-menu {{ setActive(['admin.top-bars.*', 'admin.footers.*', 'admin.social-links.*', 'admin.footer-column-one.*', 'admin.footer-column-two.*'], 'show') }}">

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.top-bars.*']) }}"
                                    href="{{ route('admin.top-bars.index') }}">
                                    Top Bar
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.footers.*']) }}"
                                    href="{{ route('admin.footers.index') }}">
                                    Footer
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.footer-column-one.*']) }}"
                                    href="{{ route('admin.footer-column-one.index') }}">
                                    Footer Column One
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.footer-column-two.*']) }}"
                                    href="{{ route('admin.footer-column-two.index') }}">
                                    Footer Column Two
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.social-links.*']) }}"
                                    href="{{ route('admin.social-links.index') }}">
                                    Social Link
                                </a>
                            </div>
                        </div>

                    </div>

                </li>

                <li
                    class="nav-item dropdown {{ setActive(['admin.counter-sections.*', 'admin.testimonial-sections.*', 'admin.featured-instructor-sections.*', 'admin.brand-sections.*', 'admin.hero-sections.*', 'admin.feature-sections.*', 'admin.about-us-sections.*', 'admin.latest-course-sections.*', 'admin.become-instructor-sections.*', 'admin.video-sections.*'], 'active') }}">

                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                                <path
                                    d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                                <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Section Management</span>
                    </a>
                    <div
                        class="dropdown-menu {{ setActive(['admin.counter-sections.*', 'admin.testimonial-sections.*', 'admin.featured-instructor-sections.*', 'admin.brand-sections.*', 'admin.hero-sections.*', 'admin.feature-sections.*', 'admin.about-us-sections.*', 'admin.latest-course-sections.*', 'admin.become-instructor-sections.*', 'admin.video-sections.*'], 'show') }}">

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.hero-sections.*']) }}"
                                    href="{{ route('admin.hero-sections.index') }}">
                                    Hero
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.feature-sections.*']) }}"
                                    href="{{ route('admin.feature-sections.index') }}">
                                    Feature
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.about-us-sections.*']) }}"
                                    href="{{ route('admin.about-us-sections.index') }}">
                                    About Us
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.latest-course-sections.*']) }}"
                                    href="{{ route('admin.latest-course-sections.index') }}">
                                    Latest Course
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.become-instructor-sections.*']) }}"
                                    href="{{ route('admin.become-instructor-sections.index') }}">
                                    Become Instructor
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.video-sections.*']) }}"
                                    href="{{ route('admin.video-sections.index') }}">
                                    Video Section
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.brand-sections.*']) }}"
                                    href="{{ route('admin.brand-sections.index') }}">
                                    Brand Section
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.featured-instructor-sections.*']) }}"
                                    href="{{ route('admin.featured-instructor-sections.index') }}">
                                    Featured Instructor
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.testimonial-sections.*']) }}"
                                    href="{{ route('admin.testimonial-sections.index') }}">
                                    Testimonial
                                </a>
                            </div>
                        </div>

                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ setActive(['admin.counter-sections.*']) }}"
                                    href="{{ route('admin.counter-sections.index') }}">
                                    Counter
                                </a>
                            </div>
                        </div>

                    </div>

                </li>



                <li class="nav-item {{ setActive(['admin.payout-gateways.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.payout-gateways.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Payout Gateway</span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.withdraw-requests.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.withdraw-requests.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Withdraw Request</span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.settings.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.settings.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Setting</span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.contacts.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Contact </span>
                    </a>
                </li>

                <li class="nav-item {{ setActive(['admin.custom-pages.index'], 'active') }}">
                    <a class="nav-link" href="{{ route('admin.custom-pages.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Custom Page </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
