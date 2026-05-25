@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feature Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.feature-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image One</label>

                                <x-input-error :messages="$errors->get('image_one')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one"
                                            src="{{ $feature->image_one ? asset($feature->image_one) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview" style="background: gray">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image_one" id="image-upload-one" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_one">Title One</label>
                                <input type="text" class="form-control" name="title_one" id="title_one"
                                    value="{{ old('title_one', $feature?->title_one) }}">
                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="subtitle_one">Subtitle One</label>
                                <input type="text" class="form-control" name="subtitle_one" id="subtitle_one"
                                    value="{{ old('subtitle_one', $feature?->subtitle_one) }}">
                                <x-input-error :messages="$errors->get('subtitle_one')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image Two</label>

                                <x-input-error :messages="$errors->get('image_two')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-two"
                                            src="{{ $feature->image_two ? asset($feature->image_two) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview" style="background: gray">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image_two" id="image-upload-two" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_two">Title Two</label>
                                <input type="text" class="form-control" name="title_two" id="title_two"
                                    value="{{ old('title_two', $feature?->title_two) }}">
                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="subtitle_two">Subtitle Two</label>
                                <input type="text" class="form-control" name="subtitle_two" id="subtitle_two"
                                    value="{{ old('subtitle_two', $feature?->subtitle_two) }}">
                                <x-input-error :messages="$errors->get('subtitle_two')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image Three</label>

                                <x-input-error :messages="$errors->get('image_three')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-three"
                                            src="{{ $feature->image_three ? asset($feature->image_three) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview" style="background: gray">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image_three" id="image-upload-three" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_three">Title Three</label>
                                <input type="text" class="form-control" name="title_three" id="title_three"
                                    value="{{ old('title_three', $feature?->title_three) }}">
                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle_three">Subtitle Three</label>
                                <input type="text" class="form-control" name="subtitle_three" id="subtitle_three"
                                    value="{{ old('subtitle_three', $feature?->subtitle_three) }}">
                                <x-input-error :messages="$errors->get('subtitle_three')" class="mt-2" />
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
