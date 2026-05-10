@extends('frontend.student.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
            <div class="wsus__dashboard_heading">
                <h5>Update Your Information</h5>
                <p>Manage your courses and its update like live, draft and insight.</p>
            </div>
            <div>
                <a href="{{ route('student.profile.index') }}" class="common_btn">Back</a>
            </div>
        </div>

        <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
            <div class="img">
                <img src="{{ asset(user()->image) }}" alt="profile" class="img-fluid w-100" id="avatarPreview">
                <label for="profile_photo">
                    <img src="{{ asset('assets/frontend/dist/images/dash_camera.png') }}" alt="camera"
                        class="img-fluid w-100">
                </label>
            </div>
            <div class="text">
                <h6>Your avatar</h6>
                <p>PNG or JPG no bigger than 400px wide and tall.</p>
            </div>
        </div>

        <form action="{{ route('student.profile.update') }}" method="post" enctype="multipart/form-data"
            class="wsus__dashboard_profile_update">
            @csrf
            @method('put')

            <input type="file" name="image" id="profile_photo" hidden="">

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Name</label>
                        <x-input-error :messages="$errors->get('name')" />
                        <input name="name" type="text" placeholder="Enter your name"
                            value="{{ old('name', user()->name) }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Headline</label>
                        <x-input-error :messages="$errors->get('headline')" />
                        <input name="headline" type="text" placeholder="Enter your headline"
                            value="{{ old('headline', user()->headline) }}">
                    </div>
                </div>

                <div class="col-xl-6" style="padding-top: 5px;">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Gender</label>
                        <x-input-error :messages="$errors->get('gender')" />
                        <select name="gender" class="form-control" style="padding: 12px">
                            <option value="">Select</option>
                            <option value="male" {{ old('gender', user()->gender) == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('gender', user()->gender) == 'female' ? 'selected' : '' }}>
                                Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>About Me</label>
                        <x-input-error :messages="$errors->get('bio')" />
                        <textarea name="bio" rows="7" placeholder="Your text here">{{ old('bio', user()->bio) }}</textarea>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Facebook</label>
                        <x-input-error :messages="$errors->get('facebook')" />
                        <input name="facebook" type="text" placeholder="Enter your facebook link"
                            value="{{ old('facebook', user()->facebook) }}">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>X (Twitter)</label>
                        <x-input-error :messages="$errors->get('x')" />
                        <input name="x" type="text" placeholder="Enter your X link"
                            value="{{ old('x', user()->x) }}">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Linkedin</label>
                        <x-input-error :messages="$errors->get('linkedin')" />
                        <input name="linkedin" type="text" placeholder="Enter your linkedin link"
                            value="{{ old('linkedin', user()->linkedin) }}">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Website</label>
                        <x-input-error :messages="$errors->get('website')" />
                        <input name="website" type="text" placeholder="Enter your website link"
                            value="{{ old('website', user()->website) }}">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Github</label>
                        <x-input-error :messages="$errors->get('github')" />
                        <input name="github" type="text" placeholder="Enter github link"
                            value="{{ old('github', user()->github) }}">
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_btn">
                        <button type="submit" class="common_btn">Update </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
            <div class="wsus__dashboard_heading">
                <h5>Update Your Password or Email</h5>
                <p>Manage your courses and its update like live, draft and insight.</p>
            </div>
        </div>

        <form action="{{ route('student.profile.password.update') }}" method="post"
            class="wsus__dashboard_profile_update">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Email</label>
                        <x-input-error :messages="$errors->get('email')" />
                        <input name="email" type="email" placeholder="Enter your email"
                            value="{{ old('email', user()->email) }}">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>New Password</label>
                        <x-input-error :messages="$errors->get('password')" />
                        <input name="password" type="password" placeholder="Enter new password">
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Confirm Password</label>
                        <x-input-error :messages="$errors->get('password_confirmation')" />
                        <input name="password_confirmation" type="password" placeholder="Confirm new password">
                    </div>
                </div>

                <div class="col-xl-12 mt-3">
                    <div class="wsus__dashboard_profile_update_btn">
                        <button type="submit" class="common_btn">Update</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script>
        document.getElementById('profile_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
