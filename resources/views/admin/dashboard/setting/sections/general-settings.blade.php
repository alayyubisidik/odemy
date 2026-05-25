@extends('admin.dashboard.setting.index')


@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">General Settings</h2>


        <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-label">Site Name</div>
                    <input type="text" class="form-control" name="site_name" value="{{ config('settings.site_name') }}">
                    <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Site Email</div>
                    <input type="email" class="form-control" name="site_email"
                        value="{{ config('settings.site_email') }}">
                    <x-input-error :messages="$errors->get('site_email')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Site Phone</div>
                    <input type="text" class="form-control" name="site_phone"
                        value="{{ config('settings.site_phone') }}">
                    <x-input-error :messages="$errors->get('site_phone')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <div class="form-label">Site Location</div>
                    <input type="text" class="form-control" name="site_location"
                        value="{{ config('settings.site_location') }}">
                    <x-input-error :messages="$errors->get('site_location')" class="mt-2" />
                </div>
                <div class="col-md-12 mb-2">
                    <div class="mb-3">
                        <label class="form-label">Site Logo</label>

                        <x-input-error :messages="$errors->get('site_logo')" />

                        <div class="image-upload-wrapper">

                            <!-- Preview -->
                            <div class="image-preview-container">
                                <img id="image-preview-one"
                                    src="{{ config('settings.site_logo') ? asset(config('settings.site_logo')) : asset('assets/images/img-placeholder.png') }}"
                                    alt="Preview">
                            </div>

                            <!-- Input -->
                            <div class="image-input-container">
                                <input type="file" name="site_logo" id="image-upload-one" accept="image/*">

                                <p class="text-muted" style="margin-top: 3px">
                                    Click to upload image
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="mb-3">
                        <label class="form-label">Site Favicon</label>

                        <x-input-error :messages="$errors->get('site_favicon')" />

                        <div class="image-upload-wrapper">

                            <!-- Preview -->
                            <div class="image-preview-container">
                                <img id="image-preview-one"
                                    src="{{ config('settings.site_favicon') ? asset(config('settings.site_favicon')) : asset('assets/images/img-placeholder.png') }}"
                                    alt="Preview">
                            </div>

                            <!-- Input -->
                            <div class="image-input-container">
                                <input type="file" name="site_favicon" id="image-upload-one" accept="image/*">

                                <p class="text-muted" style="margin-top: 3px">
                                    Click to upload image
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection
