@extends('frontend.instructor.dashboard.course.course-app')

@section('create-course-tab-content')
    <div class="tab-pane fade show active pb-3" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact-tab2"
        tabindex="0" >
        <div class="dashboard_add_course_finish">
            <form action="{{ route('instructor.courses.store.finish') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput mb-0">
                            <label>Message for Reviewer</label>
                            <x-input-error :messages="$errors->get('message_for_reviewer')" />
                            <textarea rows="8" name="message_for_reviewer" placeholder="Message for Reviewer">{{ old('message_for_reviewer', $course->message_for_reviewer ?? '') }}</textarea>
                        </div>
                    </div>

                    @php
                        $status = old('status', $course->status ?? '');
                    @endphp

                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Status *</b></label>
                            <x-input-error :messages="$errors->get('status')" />

                            <select class="select_js" name="status">
                                <option value="active" {{ $status === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                                <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="common_btn mt_25">Save</button>
            </form>
        </div>
    </div>
@endsection
