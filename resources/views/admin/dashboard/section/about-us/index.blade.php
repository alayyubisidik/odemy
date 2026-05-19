@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about-us-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image </label>
                                <x-input-error :messages="$errors->get('image')" />
                                <div class="image-preview-box">
                                    <input type="file" name="image" id="image-upload-one" accept="image/*"
                                        class="form-control" />
                                    <img id="image-preview-one" class="img-preview" alt="Logo Preview"
                                        src="{{ asset($about?->image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none {{ $about?->image ? 'display: none;' : '' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="lerner_count">Lerner Count</label>
                                <input type="number" class="form-control" name="lerner_count" id="lerner_count"
                                    value="{{ old('lerner_count', $about?->lerner_count) }}">
                                <x-input-error :messages="$errors->get('lerner_count')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="lerner_count_text">Lerner Count Text</label>
                                <input type="text" class="form-control" name="lerner_count_text" id="lerner_count_text"
                                    value="{{ old('lerner_count_text', $about?->lerner_count_text) }}">
                                <x-input-error :messages="$errors->get('lerner_count_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Lerner Image </label>
                                <x-input-error :messages="$errors->get('lerner_image')" />
                                <div class="image-preview-box">
                                    <input type="file" name="lerner_image" id="image-upload-two" accept="image/*"
                                        class="form-control" />
                                    <img id="image-preview-two" class="img-preview" alt="Logo Preview"
                                        src="{{ asset($about?->lerner_image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none {{ $about?->lerner_image ? 'display: none;' : '' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $about?->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="description">Description</label>
                                <textarea name="description" id="short-editor" class="form-control">{{ old('description', $about?->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_text">Button Text</label>
                                <input type="text" class="form-control" name="button_text" id="button_text"
                                    value="{{ old('button_text', $about?->button_text) }}">
                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="button_url">Button URL</label>
                                <input type="text" class="form-control" name="button_url" id="button_url"
                                    value="{{ old('button_url', $about?->button_url) }}">
                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Video Image </label>
                                <x-input-error :messages="$errors->get('video_image')" />
                                <div class="image-preview-box">
                                    <input type="file" name="video_image" id="image-upload-three" accept="image/*"
                                        class="form-control" />
                                    <img id="image-preview-three" class="img-preview" alt="Logo Preview"
                                        src="{{ asset($about?->video_image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px; display: none {{ $about?->lerner_image ? 'display: none;' : '' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="video_url">Video URL</label>
                                <input type="text" class="form-control" name="video_url" id="video_url"
                                    value="{{ old('video_url', $about?->video_url) }}">
                                <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
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
