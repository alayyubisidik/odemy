@extends('frontend.layouts.app')


@section('content')
       <x-breadcrumb title="Contact Us" />


    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__contact_info">
                        <div class="icon">
                            <img src="{{ asset($contact->icon_one) }}" alt="contact" class="img-fluid">
                        </div>
                        <h4>{{ $contact->title_one }}</h4>
                        <p>{{ $contact->subtitle_one }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__contact_info">
                        <div class="icon">
                            <img src="{{ asset($contact->icon_two) }}" alt="contact" class="img-fluid">
                        </div>
                        <h4>{{ $contact->title_two }}</h4>
                        <p>{{ $contact->subtitle_two }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__contact_info">
                        <div class="icon">
                            <img src="{{ asset($contact->icon_three) }}" alt="contact" class="img-fluid">
                        </div>
                        <h4>{{ $contact->title_three }}</h4>
                        <p>{{ $contact->subtitle_three }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__contact_info">
                        <div class="icon">
                            <img src="{{ asset($contact->icon_four) }}" alt="contact" class="img-fluid">
                        </div>
                        <h4>{{ $contact->title_four }}</h4>
                        <p>{{ $contact->subtitle_four }}</p>
                    </div>
                </div>

            </div>
            <div class="wsus__contact_form_area mt_30 wow fadeInUp">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5 d-md-none d-lg-block">
                        <div class="wsus__contact_form_img">
                            <img src="{{ asset($contact->image) }}" alt="contact" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <form action="{{ route('contact.store') }}"  method="post" accept="" class="wsus__contact_form">
                            @csrf
                            <h4>Send Us Message</h4>
                            <p>Your email address will not be published. Required fields are marked *</p>

                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <input type="text" name="name" placeholder="Name*" >
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <input type="email" name="email" placeholder="Email*" >
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <input type="text" name="subject" placeholder="Subject*">
                                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                </div>
                                <div class="col-xl-12">
                                    <textarea rows="5" name="message" placeholder="Comment*" ></textarea>
                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    <button type="submit" class="common_btn">Submit Now</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__contact_map mt_120 xs_mt_100 wow fadeInUp">
            <iframe src="{{ $contact->map_link }}" width="600" height="450" style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@endsection
