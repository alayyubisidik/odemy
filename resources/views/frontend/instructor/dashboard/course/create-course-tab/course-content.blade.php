@extends('frontend.instructor.dashboard.course.course-app')

@section('create-course-tab-content')
    <div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <div class="add_course_content">
            <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
                <a class="common_btn chapter-modal-btn" href="#">Add New Chapter</a>
            </div>
            <div class="accordion" id="accordionExample">
                @foreach ($chapters as $chapter)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $chapter->id }}">
                                <span>{{ $chapter->title }}</span>
                            </button>

                            <div class="add_course_content_action_btn">

                                <a href="javascript:void(0)" class="btn btn-sm btn-primary lesson-modal-btn"
                                    data-chapter-id="{{ $chapter->id }}">
                                    <i class="far fa-plus"></i>
                                    Add Lesson
                                </a>

                                <a class="edit edit-chapter-modal-btn" data-chapter-id="{{ $chapter->id }}"
                                    data-title="{{ $chapter->title }}" href="javascript:void(0)">
                                    <i class="far fa-edit"></i>
                                </a>

                                <form style="margin-bottom: 10px;"
                                    action="{{ route('instructor.course-content.destroy-chapter', $chapter) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <a class="del delete-btn" href="#">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </form>

                            </div>
                        </h2>

                        <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                                <ul class="item_list sortable_list">

                                    @foreach ($chapter->lessons ?? [] as $lesson)
                                        <li data-lesson-id="{{ $lesson->id }}" data-chapter-id="{{ $chapter->id }}">

                                            <span>{{ $lesson->title }}</span>

                                            <div class="add_course_content_action_btn">

                                                <a href="javascript:void(0)" class="edit-lesson-modal-btn"
                                                    data-lesson-id="{{ $lesson->id }}" data-title="{{ $lesson->title }}"
                                                    data-storage="{{ $lesson->storage }}"
                                                    data-file="{{ $lesson->file_path }}"
                                                    data-url="{{ $lesson->file_path }}"
                                                    data-file-type="{{ $lesson->file_type }}"
                                                    data-duration="{{ $lesson->duration }}"
                                                    data-is-preview="{{ $lesson->is_preview }}"
                                                    data-downloadable="{{ $lesson->downloadable }}"
                                                    data-description="{{ $lesson->description }}">

                                                    <i class="far fa-edit"></i>

                                                </a>

                                                <form
                                                    action="{{ route('instructor.course-content.destroy-lesson', $lesson) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('delete')

                                                    <a class="del delete-btn" style="cursor: pointer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                </form>

                                            </div>

                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('instructor.courses.create.finish', session('course_id')) }}"
                class="common_btn mt_20">Next</a>
        </div>
    </div>

    <div class="modal fade" id="chapter-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Chapter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('instructor.course-content.store-chapter') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <x-input-error :messages="$errors->get('title')" />
                            <input type="text" class="form-control" id="title" name="chapter_title"
                                placeholder="Enter title">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-chapter-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Chapter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('instructor.course-content.update-chapter') }}">
                    @csrf
                    @method('put')

                    <input type="hidden" name="chapter_id" id="edit_modal_chapter_id">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="lesson-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Lesson</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('instructor.course-content.store-lesson') }}">
                    @csrf

                    <input type="hidden" name="chapter_id" id="modal_chapter_id">

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Source</label>
                                    <select class="form-select storage" name="storage">
                                        <option value="">Please Select</option>
                                        @foreach (config('course.video_sources') as $key => $name)
                                            <option value="{{ $key }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                                {{-- UPLOAD (muncul hanya jika upload) --}}
                                <div class="add_course_basic_info_input upload_source d-none">
                                    <label>Video File</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="demo_video_source" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>

                                        <input id="demo_video_source" class="form-control" type="text"
                                            name="file">
                                    </div>
                                </div>

                                {{-- NON-UPLOAD (youtube / vimeo / external) --}}
                                <div class="add_course_basic_info_input external_source ">
                                    <label class="form-label">Path</label>

                                    <input type="text" class="form-control" name="url">
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration (minute)</label>
                                    <input type="text" class="form-control" id="duration" name="duration"
                                        placeholder="45">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="add_course_more_info_checkbox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_preview"
                                            id="flexCheckQna" value="1">
                                        <label class="form-check-label" for="flexCheckQna">Is Preview</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="add_course_basic_info_imput mb-0">
                                    <label>Description</label>
                                    <textarea rows="8" name="description" placeholder="Description"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="edit-lesson-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Lesson</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('instructor.course-content.update-lesson') }}">
                    @csrf
                    @method('put')

                    <input type="hidden" name="lesson_id" id="edit_modal_lesson_id">

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Source</label>
                                    <select class="form-select storage" name="storage">
                                        <option value="">Please Select</option>
                                        @foreach (config('course.video_sources') as $key => $name)
                                            <option value="{{ $key }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                                {{-- UPLOAD (muncul hanya jika upload) --}}
                                <div class="add_course_basic_info_input upload_source d-none">
                                    <label>Video File</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="edit-lfm" data-input="edit-lesson-source" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>

                                        <input id="edit-lesson-source" class="form-control" type="text"
                                            name="file">
                                    </div>
                                </div>

                                {{-- NON-UPLOAD (youtube / vimeo / external) --}}
                                <div class="add_course_basic_info_input external_source ">
                                    <label class="form-label">Path</label>

                                    <input type="text" class="form-control" name="url">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_type" class="form-label">File Type</label>
                                    <select class=" form-select" name="file_type">
                                        <option value="">Please Select</option>
                                        @foreach (config('course.file_types') as $key => $name)
                                            <option value="{{ $key }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration</label>
                                    <input type="text" class="form-control" id="duration" name="duration"
                                        placeholder="Enter duration">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="add_course_more_info_checkbox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_preview"
                                            id="flexCheckQna" value="1">
                                        <label class="form-check-label" for="flexCheckQna">Is Preview</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="certificate"
                                            id="flexCheckCertificate" value="1">
                                        <label class="form-check-label" for="flexCheckCertificate">Downloadable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="add_course_basic_info_imput mb-0">
                                    <label>Description</label>
                                    <textarea rows="8" name="description" placeholder="Description"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#lfm').filemanager('file');
        $('#edit-lfm').filemanager('file');

        var notyf = new Notyf({
            duration: 10000
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif

        $('.chapter-modal-btn').on('click', function(e) {
            $('#chapter-modal').modal("show");
        });

        $('.lesson-modal-btn').on('click', function(e) {
            const chapterId = $(this).data('chapter-id');

            $('#modal_chapter_id').val(chapterId);
            $('#lesson-modal').modal('show');
        });


        $(document).on('click', '.edit-chapter-modal-btn', function() {

            let btn = $(this);
            let modal = $('#edit-chapter-modal');

            // hidden
            modal.find('#edit_modal_chapter_id').val(btn.data('chapter-id'));

            // input text
            modal.find('input[name="title"]').val(btn.data('title'));

            // show modal
            modal.modal('show');
        });


        $(document).on('click', '.edit-lesson-modal-btn', function() {

            let btn = $(this);
            let modal = $('#edit-lesson-modal');

            // hidden
            modal.find('#edit_modal_lesson_id').val(btn.data('lesson-id'));

            // input text
            modal.find('input[name="title"]').val(btn.data('title'));
            modal.find('input[name="duration"]').val(btn.data('duration'));
            modal.find('textarea[name="description"]').val(btn.data('description'));

            // select
            modal.find('select[name="storage"]')
                .val(btn.data('storage'))
                .trigger('change');

            modal.find('select[name="file_type"]').val(btn.data('file-type'));

            // checkbox
            modal.find('input[name="is_preview"]')
                .prop('checked', btn.data('is-preview') == 1);

            modal.find('input[name="certificate"]')
                .prop('checked', btn.data('downloadable') == 1);

            // file / url
            if (btn.data('storage') === 'upload') {
                modal.find('input[name="file"]').val(btn.data('file'));
                modal.find('.upload_source').removeClass('d-none');
                modal.find('.external_source').addClass('d-none');
            } else {
                modal.find('input[name="url"]').val(btn.data('url'));
                modal.find('.upload_source').addClass('d-none');
                modal.find('.external_source').removeClass('d-none');
            }

            // show modal
            modal.modal('show');
        });


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
            $('.storage').on('change', function() {
                toggleDemoSource($(this).val());
            });

            // saat halaman pertama kali dibuka (edit page)
            toggleDemoSource($('.storage').val());
        });
    </script>
@endpush
