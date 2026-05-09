@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update User</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>

                                <x-input-error :messages="$errors->get('image')" />

                                <div class="image-upload-wrapper">

                                    <!-- Preview -->
                                    <div class="image-preview-container">
                                        <img id="image-preview-one"
                                            src="{{ $user->image ? asset($user->image) : asset('assets/images/img-placeholder.png') }}"
                                            alt="Preview">
                                    </div>

                                    <!-- Input -->
                                    <div class="image-input-container">
                                        <input type="file" name="image" id="image-upload-one" accept="image/*">

                                        <p class="text-muted" style="margin-top: 3px">
                                            Click to upload image
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="name">Name</label>

                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $user->name) }}">

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="email">Email</label>

                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email', $user->email) }}">

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 password-group">
                            <label class="form-label">Password</label>

                            <div class="password-wrapper">

                                <input type="password" name="password" class="form-control password-input">

                                <span class="toggle-password">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">

                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>

                                </span>
                            </div>

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-3 password-group">

                            <label class="form-label">Confirm Password</label>

                            <div class="password-wrapper">

                                <input type="password" name="password_confirmation" class="form-control password-input">

                                <span class="toggle-password">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">

                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>

                                </span>
                            </div>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="col-12">
                            <div class="mb-4">

                                <label class="form-label required" for="role">Role</label>

                                <select name="role" id="role" class="form-select">

                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>
                                        Student
                                    </option>

                                    <option value="instructor"
                                        {{ old('role', $user->role) == 'instructor' ? 'selected' : '' }}>
                                        Instructor
                                    </option>

                                </select>

                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">

                                <label class="form-label required" for="is_blocked">
                                    Status
                                </label>

                                <select name="is_blocked" id="is_blocked" class="form-select">

                                    <option value="0"
                                        {{ old('is_blocked', $user->is_blocked) == 0 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="1"
                                        {{ old('is_blocked', $user->is_blocked) == 1 ? 'selected' : '' }}>
                                        Blocked
                                    </option>

                                </select>

                                <x-input-error :messages="$errors->get('is_blocked')" class="mt-2" />

                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager('file');


        $(document).ready(function() {

            function toggleDemoSource(value) {
                if (value === 'upload') {
                    $('.upload_source').removeClass('d-none');
                    $('.external_source').addClass('d-none');
                } else {
                    $('.upload_source').addClass('d-none');
                    $('.external_source').removeClass('d-none');
                }
            }

            // saat select berubah
            $('#demo_video_storage').on('change', function() {
                toggleDemoSource($(this).val());
            });

            // saat halaman pertama kali dibuka (edit page)
            toggleDemoSource($('#demo_video_storage').val());
        });
    </script>
@endpush
