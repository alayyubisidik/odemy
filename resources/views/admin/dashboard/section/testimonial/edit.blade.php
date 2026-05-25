@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Testimonial Edit</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.testimonial-sections.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonial-sections.update', $testimonial_section) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="rating">Rating</label>
                                <input type="number" class="form-control" name="rating" id="rating"
                                    value="{{ old('rating', $testimonial_section->rating) }}">
                                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="review">Review</label>
                                <input type="text" class="form-control" name="review" id="review"
                                    value="{{ old('review', $testimonial_section->review) }}">
                                <x-input-error :messages="$errors->get('review')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Client Image</label>

                                <x-input-error :messages="$errors->get('user_image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one"
                                            src="{{ $testimonial_section->user_image ? asset($testimonial_section->user_image) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="user_image" id="image-upload-one" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="user_name">Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name"
                                value="{{ old('user_name', $testimonial_section->user_name) }}">
                            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label required" for="user_title">Title</label>
                            <input type="text" class="form-control" name="user_title" id="user_title"
                                value="{{ old('user_title', $testimonial_section->user_title) }}">
                            <x-input-error :messages="$errors->get('user_title')" class="mt-2" />
                        </div>
                    </div>



            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
