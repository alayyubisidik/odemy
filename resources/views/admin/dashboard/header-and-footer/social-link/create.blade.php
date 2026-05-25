@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Social Link</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <x-input-error :messages="$errors->get('icon')" />

                                <div class="image-upload-wrapper">

                                    <!-- Kiri: Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-two" style="background: gray" src="{{ asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Kanan: Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="icon" id="image-upload-two" accept="image/*">
                                        <p class="text-muted" style="margin-top: 3px">Click to upload image</p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="link">Link</label>
                                <input type="text" class="form-control" name="link" id="link"
                                    value="{{ old('link') }}">
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="status" {{ old('status', 1) ? 'checked' : '' }}>
                                    <span class="form-check-label">Active</span>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
