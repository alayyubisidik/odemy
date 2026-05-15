@extends('frontend.instructor.dashboard.course.course-app')

@push('styles')
    <style>
        .img-preview {
            width: 200px !important;
        }
    </style>
@endpush

@section('create-course-tab-content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form id="basic_info_form" action="{{ route('instructor.courses.store.basic-info') }}" method="POST" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <!-- Title -->
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Title *</label>
                            <x-input-error :messages="$errors->get('title')" />
                            <input type="text" name="title" placeholder="Title" id="name"
                                value="{{ old('title', $course->title ?? '') }}" id="name">
                        </div>
                    </div>

                    <!-- Slug -->
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Slug *</label>
                            <x-input-error :messages="$errors->get('slug')" />
                            <input type="text" name="slug" placeholder="Slug" id="slug"
                                value="{{ old('slug', $course->slug ?? '') }}" id="slug">
                        </div>
                    </div>

                    <!-- SEO Description -->
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Seo description</label>
                            <x-input-error :messages="$errors->get('seo_description')" />
                            <input type="text" name="seo_description" placeholder="Seo description"
                                value="{{ old('seo_description', $course->seo_description ?? '') }}">
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Thumbnail *</label>
                            <x-input-error :messages="$errors->get('thumbnail')" />
                            <input type="file" id="image-upload-one" name="thumbnail">

                            <img id="image-preview-one" alt="Logo Preview" src="{{ asset($course?->thumbnail) }}"
                                style="width: 300px !important; height: auto; border-radius: 5px; margin-top: 20px; {{ $course?->thumbnail ? '' : 'display: none;' }}" />
                        </div>
                    </div>

                    @php
                        $demoStorage = old('demo_video_storage', $course->demo_video_storage ?? '');
                    @endphp

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label>Demo Video Storage <b>(optional)</b></label>
                            <x-input-error :messages="$errors->get('demo_video_storage')" />

                            <select class="select_js demo_video_storage" name="demo_video_storage">
                                <option value="">Please Select</option>

                                <option value="upload" {{ $demoStorage === 'upload' ? 'selected' : '' }}>
                                    Upload
                                </option>

                                <option value="youtube" {{ $demoStorage === 'youtube' ? 'selected' : '' }}>
                                    YouTube
                                </option>

                                <option value="vimeo" {{ $demoStorage === 'vimeo' ? 'selected' : '' }}>
                                    Vimeo
                                </option>

                                <option value="external_link" {{ $demoStorage === 'external_link' ? 'selected' : '' }}>
                                    External Link
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="col-xl-6">

                        {{-- UPLOAD (muncul hanya jika upload) --}}
                        <div
                            class="add_course_basic_info_input upload_source {{ $demoStorage === 'upload' ? '' : 'd-none' }}">
                            <label>Video File</label>

                            <x-input-error :messages="$errors->get('demo_video_source')" />

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="demo_video_source" data-preview="holder"
                                        class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>

                                <input id="demo_video_source" class="form-control" type="text" name="file"
                                    value="{{ old('file', $course->demo_video_source ?? '') }}">
                            </div>
                        </div>

                        {{-- NON-UPLOAD (youtube / vimeo / external) --}}
                        <div
                            class="add_course_basic_info_input external_source {{ $demoStorage === 'upload' ? 'd-none' : '' }}">
                            <label>Path</label>

                            <x-input-error :messages="$errors->get('demo_video_source')" />

                            <input type="text" name="url"
                                value="{{ old('url', $course->demo_video_source ?? '') }}">
                        </div>

                    </div>


                    <!-- Price -->
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">

                            <label>Price (RP)*</label>

                            <x-input-error :messages="$errors->get('price')" />

                            <input type="text" name="price" class="rupiah-input" placeholder="Price"
                                value="{{ old('price', isset($course) ? number_format($course->price, 0, ',', '.') : '') }}">

                            <p>Put 0 for free</p>

                        </div>
                    </div>

                    <!-- Discount -->
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">

                            <label>Discount Price (RP)</label>

                            <x-input-error :messages="$errors->get('discount')" />

                            <input type="text" name="discount" class="rupiah-input" placeholder="Discount Price"
                                value="{{ old('discount', isset($course) ? number_format($course->discount, 0, ',', '.') : '') }}">

                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput mb-0">
                            <label>Description</label>
                            <x-input-error :messages="$errors->get('description')" />
                            <textarea rows="8" name="description" placeholder="Description">{{ old('description', $course->description ?? '') }}</textarea>

                            <button type="submit" class="common_btn mt_20">Save</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection


@push('script')
    <script>
        $('#lfm').filemanager('file');


        $(document).ready(function() {

            function toggleDemoSource(value) {
                if (value === 'upload') {
                    $('.upload_source').removeClass('d-none');
                    $('.external_source').addClass('d-none');
                } else {
                    $('.upload_source').addClass('d-none');
                    $('.external_source').removeClass('d-none');
                }
            }

            // saat select berubah
            $('.demo_video_storage').on('change', function() {
                toggleDemoSource($(this).val());
            });

            // saat halaman pertama kali dibuka (edit page)
            toggleDemoSource($('.demo_video_storage').val());
        });

        $('.rupiah-input').on('input', function() {

            let value = $(this).val();

            value = value.replace(/[^0-9]/g, '');

            value = new Intl.NumberFormat('id-ID').format(value);

            $(this).val(value);
        });
    </script>
@endpush
