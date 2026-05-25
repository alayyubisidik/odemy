@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Page Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contacts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon One</label>

                                <x-input-error :messages="$errors->get('icon_one')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one"
                                            src="{{ $contact->icon_one ? asset($contact->icon_one) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon_one" id="image-upload-one" accept="image/*">

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
                                    value="{{ old('title_one', $contact?->title_one) }}">
                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle_one">Subtitle One</label>
                                <input type="text" class="form-control" name="subtitle_one" id="subtitle_one"
                                    value="{{ old('subtitle_one', $contact?->subtitle_one) }}">
                                <x-input-error :messages="$errors->get('subtitle_one')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon Two</label>

                                <x-input-error :messages="$errors->get('icon_two')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-two"
                                            src="{{ $contact->icon_two ? asset($contact->icon_two) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon_two" id="image-upload-two" accept="image/*">

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
                                    value="{{ old('title_two', $contact?->title_two) }}">
                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle_two">Subtitle Two</label>
                                <input type="text" class="form-control" name="subtitle_two" id="subtitle_two"
                                    value="{{ old('subtitle_two', $contact?->subtitle_two) }}">
                                <x-input-error :messages="$errors->get('subtitle_two')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon Three</label>

                                <x-input-error :messages="$errors->get('icon_three')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-three"
                                            src="{{ $contact->icon_three ? asset($contact->icon_three) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon_three" id="image-upload-three" accept="image/*">

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
                                    value="{{ old('title_three', $contact?->title_three) }}">
                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle_three">Subtitle Three</label>
                                <input type="text" class="form-control" name="subtitle_three" id="subtitle_three"
                                    value="{{ old('subtitle_three', $contact?->subtitle_three) }}">
                                <x-input-error :messages="$errors->get('subtitle_three')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon Four</label>

                                <x-input-error :messages="$errors->get('icon_four')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-four"
                                            src="{{ $contact->icon_four ? asset($contact->icon_four) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon_four" id="image-upload-four" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_four">Title Four</label>
                                <input type="text" class="form-control" name="title_four" id="title_four"
                                    value="{{ old('title_four', $contact?->title_four) }}">
                                <x-input-error :messages="$errors->get('title_four')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="subtitle_four">Subtitle Four</label>
                                <input type="text" class="form-control" name="subtitle_four" id="subtitle_four"
                                    value="{{ old('subtitle_four', $contact?->subtitle_four) }}">
                                <x-input-error :messages="$errors->get('subtitle_four')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>

                                <x-input-error :messages="$errors->get('image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-five"
                                            src="{{ $contact->image ? asset($contact->image) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image" id="image-upload-five" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="map_link">Map Link</label>
                                <input type="text" class="form-control" name="map_link" id="map_link"
                                    value="{{ old('map_link', $contact?->map_link) }}">
                                <x-input-error :messages="$errors->get('map_link')" class="mt-2" />
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
