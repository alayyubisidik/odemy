@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }} > {{ $chapter->title }} (Update)</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.courses.chapters.index', $course) }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.chapters.update', [$course, $chapter]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $chapter->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_active" @checked($chapter->is_active) >
                                    <span class="form-check-label">Is Active</span>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
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

