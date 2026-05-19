@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Featured Instructor Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.featured-instructor-sections.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $featuredInstructorSection?->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle"
                                    value="{{ old('subtitle', $featuredInstructorSection?->subtitle) }}">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_text">Button Text</label>
                                <input type="text" class="form-control" name="button_text" id="button_text"
                                    value="{{ old('button_text', $featuredInstructorSection?->button_text) }}">
                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_url">Button URL</label>
                                <input type="text" class="form-control" name="button_url" id="button_url"
                                    value="{{ old('button_url', $featuredInstructorSection?->button_url) }}">
                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label">Instructor</div>
                            <select name="instructor_id" id="" class="form-control select2 select_instructor">
                                @foreach ($instructors as $instructor)
                                    <option @selected($instructor->id == old('instructor_id', $featuredInstructorSection?->instructor_id)) value="{{ $instructor->id }}">
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('instructor_id')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label">Courses</div>
                            <select name="featured_courses[]" id="" class="form-control select2 select-courses"
                                multiple>
                                @foreach ($selectedInstructorCourses as $item)
                                    <option @selected(in_array($item->id, old('featured_courses', $selectedCourses))) value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('featured_courses')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Instructor Image </label>
                                <x-input-error :messages="$errors->get('instructor_image')" />
                                <div class="image-preview-box">
                                    <input type="file" name="instructor_image" id="image-upload-one" accept="image/*"
                                        class="form-control" />
                                    <img id="image-preview-one" class="img-preview" alt="Logo Preview"
                                        src="{{ asset($featuredInstructorSection?->instructor_image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none {{ $featuredInstructorSection?->instructor_image ? 'display: none;' : '' }}" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(function() {
            $('.select_instructor').on('change', function() {
                let instructor_id = $(this).val();
                $.ajax({
                    url: "{{ route('admin.get-instructor-courses', ':instructor_id') }}".replace(
                        ':instructor_id', instructor_id),
                    method: 'GET',
                    success: function(res) {
                        let options = '';
                        res.courses.forEach(course => {
                            options +=
                                `<option value="${course.id}">${course.title}</option>`;
                        });
                        $('.select-courses').html(options);
                    }
                })
            });
        })
    </script>
@endpush
