@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Become an Instructor Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.become-instructor-sections.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>

                                <x-input-error :messages="$errors->get('image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-three"
                                            src="{{ $becomeInstructorSection->image ? asset($becomeInstructorSection->image) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview" style="background: gray">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image" id="image-upload-three" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $becomeInstructorSection?->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle"
                                    value="{{ old('subtitle', $becomeInstructorSection?->subtitle) }}">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_text">Button Text</label>
                                <input type="text" class="form-control" name="button_text" id="button_text"
                                    value="{{ old('button_text', $becomeInstructorSection?->button_text) }}">
                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_url">Button URL</label>
                                <input type="text" class="form-control" name="button_url" id="button_url"
                                    value="{{ old('button_url', $becomeInstructorSection?->button_url) }}">
                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
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
