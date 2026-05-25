@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Video Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.video-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Background</label>

                                <x-input-error :messages="$errors->get('background')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-three"
                                            src="{{ $videoSection->background ? asset($videoSection->background) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview" style="background: gray">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="background" id="image-upload-three" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="video_url">Video URL</label>
                                <input type="text" class="form-control" name="video_url" id="video_url"
                                    value="{{ old('video_url', $videoSection?->video_url) }}">
                                <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description"
                                    value="{{ old('description', $videoSection?->description) }}">
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_text">Button Text</label>
                                <input type="text" class="form-control" name="button_text" id="button_text"
                                    value="{{ old('button_text', $videoSection?->button_text) }}">
                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_url">Button URL</label>
                                <input type="text" class="form-control" name="button_url" id="button_url"
                                    value="{{ old('button_url', $videoSection?->button_url) }}">
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
