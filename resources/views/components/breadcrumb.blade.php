<section class="wsus__breadcrumb"
    style="background: url('{{ asset(config('settings.site_breadcrumb')) }}');">

    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="wsus__breadcrumb_text">

                        <h1>{{ $title }}</h1>

                        <ul>
                            <li>
                                <a href="{{ route('index') }}">Home</a>
                            </li>

                            <li>{{ $title }}</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
