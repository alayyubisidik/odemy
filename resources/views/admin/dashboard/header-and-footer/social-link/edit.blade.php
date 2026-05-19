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
                                <label class="form-label">Icon </label>
                                <x-input-error :messages="$errors->get('icon')" />
                                <div class="image-preview-box">
                                    <input type="file" name="icon" id="image-upload-one" accept="image/*"
                                        class="form-control" />
                                    <img id="image-preview-one" class="img-preview" alt="Logo Preview" src="{{ asset($social_link->icon) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px;  {{ $social_link->icon ? '' : 'display: none' }}" />
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
                                    <input type="checkbox" class="form-check-input" value="1"
                                        name="status" @checked($social_link->status)>
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
