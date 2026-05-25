@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Brand</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.brand-sections.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.brand-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <x-input-error :messages="$errors->get('image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Kiri: Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one" src="{{ asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Kanan: Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image" id="image-upload-one" accept="image/*">
                                        <p class="text-muted" style="margin-top: 3px">Click to upload image</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url"
                                    value="{{ old('url') }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
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
