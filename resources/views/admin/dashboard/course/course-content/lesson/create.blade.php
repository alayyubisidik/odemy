@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }} > {{ $chapter->title }} > Lessons (Create)</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.lessons.index', [$course, $chapter]) }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.lessons.store', [$course, $chapter]) }}" method="post"
                    enctype="multipart/form-data">
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
                                <label class="form-label required" for="storage">Source</label>
                                <x-input-error :messages="$errors->get('storage')" />
                                <select name="storage" id="demo_video_storage" class="form-select">
                                    <option value="">Please Select</option>

                                    <option value="upload" {{ old('storage') == 'upload' ? 'selected' : '' }}>
                                        Upload
                                    </option>
                                    <option value="youtube" {{ old('storage') == 'youtube' ? 'selected' : '' }}>
                                        Youtube
                                    </option>
                                    <option value="vimeo" {{ old('storage') == 'vimeo' ? 'selected' : '' }}>
                                        Vimeo
                                    </option>
                                    <option value="external_link" {{ old('storage') == 'external_link' ? 'selected' : '' }}>
                                        External Link
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">

                                <div class="upload_source">
                                    <label class="form-label required" for="file_path">VIdeo File</label>
                                    <x-input-error :messages="$errors->get('file')" />
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="file_path" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>

                                        <input id="file_path" class="form-control" type="text" name="file"
                                            value="{{ old('file') }}">
                                    </div>
                                </div>

                                <div class="external_source">
                                    <label class="form-label required" for="path">Path</label>
                                    <x-input-error :messages="$errors->get('url')" />
                                    <input type="text" class="form-control" name="url" id="path"
                                        value="{{ old('url') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="file_type">File Type</label>
                                <select name="file_type" id="file_type" class="form-select">
                                    <option value="">Please Select</option>
                                    <option value="video" {{ old('file_type') == 'video' ? 'selected' : '' }}>
                                        Video
                                    </option>
                                    <option value="audio" {{ old('file_type') == 'audio' ? 'selected' : '' }}>
                                        Audio
                                    </option>
                                    <option value="doc" {{ old('file_type') == 'doc' ? 'selected' : '' }}>
                                        Doc
                                    </option>
                                    <option value="file" {{ old('file_type') == 'file' ? 'selected' : '' }}>
                                        File
                                    </option>
                                    <option value="pdf" {{ old('file_type') == 'pdf' ? 'selected' : '' }}>
                                        Pdf
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('file_type')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="duration">Duration (Minutes)</label>
                                <x-input-error :messages="$errors->get('duration')" />
                                <input type="text" class="form-control" name="duration" id="duration"
                                    value="{{ old('duration') }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_preview"
                                        {{ old('is_preview') ? 'checked' : '' }}>
                                    <span class="form-check-label">Is Preview</span>
                                    <x-input-error :messages="$errors->get('is_preview')" class="mt-2" />
                                </label>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="downloadable"
                                        {{ old('downloadable') ? 'checked' : '' }}>
                                    <span class="form-check-label">Downloadable</span>
                                    <x-input-error :messages="$errors->get('downloadable')" class="mt-2" />

                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="description">Description</label>
                                <textarea name="description" id="editor">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="is_active">
                                    <span class="form-check-label">Is Active</span>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Create</button>
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
