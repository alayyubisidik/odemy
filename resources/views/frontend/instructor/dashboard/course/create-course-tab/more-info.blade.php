@extends('frontend.instructor.dashboard.course.course-app')

@section('create-course-tab-content')
    <div id="course-form-start"></div>
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="add_course_more_info">
            <form action="{{ route('instructor.courses.store.more-info') }}" method="post">
                @csrf
                <div class="row">
                    <!-- Capacity -->
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="capacity">Capacity</label>
                            <x-input-error :messages="$errors->get('capacity')" />
                            <input name="capacity" type="number" placeholder="Capacity"
                                value="{{ old('capacity', $course->capacity ?? '') }}">
                            <p>leave blank for unlimited</p>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="duration">Course Duration</label>
                            <x-input-error :messages="$errors->get('duration')" />
                            <input name="duration" type="text" placeholder="10h 30m"
                                value="{{ old('duration', $course->duration ?? '') }}">
                        </div>
                    </div>
                    <!-- Q&A & Certificate -->
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="qna" id="flexCheckQna"
                                    value="1" {{ old('qna', $course->qna ?? 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckQna">Q&A</label>
                                <x-input-error :messages="$errors->get('qna')" />
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="certificate" id="flexCheckCertificate"
                                    value="1" {{ old('certificate', $course->certificate ?? 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckCertificate">Completion Certificate</label>
                                <x-input-error :messages="$errors->get('certificate')" />
                            </div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-12">
                        <div class="add_course_more_info_input">
                            <label for="category_id">Category *</label>
                            <x-input-error :messages="$errors->get('category_id')" />
                            <select name="category_id" class="select_2">
                                <option value="">Please Select</option>
                                @foreach ($categories as $category)
                                    @if ($category->subCategories->isNotEmpty())
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}"
                                                    {{ old('category_id', $course->category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                                                    {{ $subCategory->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Level -->
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Level</h3>
                            @foreach ($levels as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_level_id"
                                        id="level-{{ $level->id }}" value="{{ $level->id }}"
                                        {{ old('course_level_id', $course->course_level_id ?? '') == $level->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="level-{{ $level->id }}">
                                        {{ $level->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('course_level_id')" />
                    </div>

                    <!-- Language -->
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Language</h3>
                            @foreach ($languages as $language)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_language_id"
                                        id="lang-{{ $language->id }}" value="{{ $language->id }}"
                                        {{ old('course_language_id', $course->course_language_id ?? '') == $language->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lang-{{ $language->id }}">
                                        {{ $language->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('course_language_id')" />
                    </div>

                    <!-- Submit -->
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
