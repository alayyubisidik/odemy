@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hero Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hero-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="label">Label</label>
                                <input type="text" class="form-control" name="label" id="label"
                                    value="{{ old('label', $hero?->label) }}">
                                <x-input-error :messages="$errors->get('label')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $hero?->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle"
                                    value="{{ old('subtitle', $hero?->subtitle) }}">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_text">Button Text</label>
                                <input type="text" class="form-control" name="button_text" id="button_text"
                                    value="{{ old('button_text', $hero?->button_text) }}">
                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_url">Button URL</label>
                                <input type="text" class="form-control" name="button_url" id="button_url"
                                    value="{{ old('button_url', $hero?->button_url) }}">
                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="video_button_text">Video Button Text</label>
                                <input type="text" class="form-control" name="video_button_text" id="video_button_text"
                                    value="{{ old('video_button_text', $hero?->video_button_text) }}">
                                <x-input-error :messages="$errors->get('video_button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="video_button_url">Video Button URL</label>
                                <input type="text" class="form-control" name="video_button_url" id="video_button_url"
                                    value="{{ old('video_button_url', $hero?->video_button_url) }}">
                                <x-input-error :messages="$errors->get('video_button_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="banner_item_title">Banner Item Title</label>
                                <input type="text" class="form-control" name="banner_item_title" id="banner_item_title"
                                    value="{{ old('banner_item_title', $hero?->banner_item_title) }}">
                                <x-input-error :messages="$errors->get('banner_item_title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="banner_item_subtitle">Banner Item Subtitle</label>
                                <input type="text" class="form-control" name="banner_item_subtitle"
                                    id="banner_item_subtitle"
                                    value="{{ old('banner_item_subtitle', $hero?->banner_item_subtitle) }}">
                                <x-input-error :messages="$errors->get('banner_item_subtitle')" class="mt-2" />
                            </div>
                        </div>


                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>

                                <x-input-error :messages="$errors->get('image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one"
                                            src="{{ $hero->image ? asset($hero->image) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image" id="image-upload-one" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

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
