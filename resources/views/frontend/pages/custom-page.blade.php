@extends('frontend.layouts.app')


@section('content')
       <x-breadcrumb title="{{ $page->title }}" />

    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="wsus__contact_form_area mt_30 wow fadeInUp">
                {!! $page->description !!}
            </div>
        </div>
    </section>
@endsection
