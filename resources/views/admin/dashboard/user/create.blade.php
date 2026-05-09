@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create User</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
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
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="password">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 password-group">
                            <label class="form-label required">Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" class="form-control password-input">

                                <span class="toggle-password">
                                    <!-- icon kamu -->
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
                            <label class="form-label required">Confirm Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="password_confirmation" class="form-control password-input">

                                <span class="toggle-password">
                                    <!-- icon sama -->
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
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>
                                        Student</option>
                                    <option value="instructor" {{ old('role') == 'instructor' ? 'selected' : '' }}>Instructor
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
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


@push('script')
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const input = this.closest('.password-wrapper').querySelector('.password-input');

                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                // optional efek icon
                this.style.opacity = isPassword ? '1' : '0.5';
            });
        });
    </script>
@endpush
