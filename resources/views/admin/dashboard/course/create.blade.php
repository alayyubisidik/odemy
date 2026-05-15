@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <h3 class="card-title">Course Information</h3>
                    <p style="margin-top: 3px">
                        Please complete the course information first before adding the course content.
                    </p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="title">Title</label>
                                <x-input-error :messages="$errors->get('title')" />
                                <input type="text" class="form-control" name="title" id="name"
                                    value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="slug">Slug</label>
                                <x-input-error :messages="$errors->get('slug')" />
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="price">Price (RP)</label>
                                <x-input-error :messages="$errors->get('price')" />
                                <input type="number" class="form-control" name="price" id="price"
                                    value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="discount">Discount (RP)</label>
                                <x-input-error :messages="$errors->get('discount')" />
                                <input type="number" class="form-control" name="discount" id="discount"
                                    value="{{ old('discount') }}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-4">
                                <label class="form-label">Thumbnail</label>
                                <x-input-error :messages="$errors->get('thumbnail')" />
                                <div class="image-preview-box">
                                    <input type="file" name="thumbnail" id="course-thumbnail-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="course-thumbnail-preview" class="img-preview" alt="Logo Preview" src=""
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none" />
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="demo_video_storage">Demo Video Storage</label>
                                <x-input-error :messages="$errors->get('demo_video_storage')" />
                                <select name="demo_video_storage" id="demo_video_storage" class="form-select">
                                    <option value="">Please Select</option>

                                    <option value="upload" {{ old('demo_video_storage') == 'upload' ? 'selected' : '' }}>
                                        Upload
                                    </option>
                                    <option value="youtube" {{ old('demo_video_storage') == 'youtube' ? 'selected' : '' }}>
                                        Youtube
                                    </option>
                                    <option value="vimeo" {{ old('demo_video_storage') == 'vimeo' ? 'selected' : '' }}>
                                        Vimeo
                                    </option>
                                    <option value="external_link"
                                        {{ old('demo_video_storage') == 'external_link' ? 'selected' : '' }}>
                                        External Link
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">

                                <div class="upload_source">
                                    <label class="form-label required" for="path">VIdeo File</label>
                                    <x-input-error :messages="$errors->get('demo_video_source')" />
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="demo_video_source" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>

                                        <input id="demo_video_source" class="form-control" type="text" name="file"
                                            value="{{ old('file') }}">
                                    </div>
                                </div>

                                <div class="external_source">
                                    <label class="form-label required" for="path">Path</label>
                                    <x-input-error :messages="$errors->get('demo_video_source')" />
                                    <input type="text" class="form-control" name="url" id="path"
                                        value="{{ old('demo_video_source') }}">
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="seo_description">SEO Description</label>
                                <textarea name="seo_description" id="short-editor">{{ old('seo_description') }}</textarea>
                                <x-input-error :messages="$errors->get('seo_description')" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="description">Description</label>
                                <textarea name="description" id="editor">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="capacity">Capacity</label>
                                <x-input-error :messages="$errors->get('capacity')" />
                                <input type="number" class="form-control" name="capacity" id="capacity"
                                    value="{{ old('capacity') }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="duration">Course Duration (Minutes)*</label>
                                <x-input-error :messages="$errors->get('duration')" />
                                <input type="number" class="form-control" name="duration" id="duration"
                                    value="{{ old('duration') }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="qna" {{ old('qna', $course->qna ?? 1) ? 'checked' : '' }}>
                                    <span class="form-check-label">Q&A</span>
                                    <x-input-error :messages="$errors->get('qna')" class="mt-2" />
                                </label>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="certificate"
                                        {{ old('certificate', $course->certificate ?? 1) ? 'checked' : '' }}>
                                    <span class="form-check-label">Completion Certificate</span>
                                    <x-input-error :messages="$errors->get('certificate')" class="mt-2" />

                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <select name="category_id" id="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_id', $course->category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label class="form-label required" for="course_level_id">Course Level</label>
                                <x-input-error :messages="$errors->get('course_level_id')" />
                                @foreach ($levels as $level)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="course_level_id"
                                            id="level-{{ $level->id }}" value="{{ $level->id }}"
                                            {{ old('course_level_id', $course->course_level_id ?? '') == $level->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="level-{{ $level->id }}">
                                            {{ $level->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label class="form-label required" for="course_language_id">Course Language</label>
                                <x-input-error :messages="$errors->get('course_language_id')" />
                                @foreach ($languages as $language)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="course_language_id"
                                            id="level-{{ $language->id }}" value="{{ $language->id }}"
                                            {{ old('course_language_id', $course->course_language_id ?? '') == $language->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="level-{{ $language->id }}">
                                            {{ $language->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="message_for_reviewer">Message For Reviewer</label>
                                <textarea name="message_for_reviewer" id="editor">{{ old('message_for_reviewer') }}</textarea>
                                <x-input-error :messages="$errors->get('message_for_reviewer')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="is_approved">Approve Status</label>
                                <select name="is_approved" id="is_approved" class="form-select">
                                    <option value="pending" {{ old('is_approved') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="approved" {{ old('is_approved') == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected" {{ old('is_approved') == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('is_approved')" class="mt-2" />
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
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
            $('#demo_video_storage').on('change', function() {
                toggleDemoSource($(this).val());
            });

            // saat halaman pertama kali dibuka (edit page)
            toggleDemoSource($('#demo_video_storage').val());
        });
    </script>
@endpush
