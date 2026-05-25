@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Social Link Edit</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.update', $social_link) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>

                                <x-input-error :messages="$errors->get('icon')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one" style="background: gray"
                                            src="{{ $social_link->icon ? asset($social_link->icon) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon" id="image-upload-one" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="link">Link</label>
                                <input type="text" class="form-control" name="link" id="link"
                                    value="{{ old('link', $social_link->link) }}">
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="status"
                                        @checked($social_link->status)>
                                    <span class="form-check-label">Active</span>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </label>
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
