@extends('admin.dashboard.setting.index')


@section('settings_content')
    <div class="card-body">
        <h2 class="mb-4">General Settings</h2>


        <form action="{{ route('admin.settings.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
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
                <div class="col-md-12">
                    <div class="form-label">Site Location</div>
                    <input type="text" class="form-control" name="site_location"
                        value="{{ config('settings.site_location') }}">
                    <x-input-error :messages="$errors->get('site_location')" class="mt-2" />
                </div>

            </div>
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary btn-2 mt-5"> Submit </button>
            </div>
        </form>
    </div>
@endsection
