@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Course Sub Category of ({{ $courseCategory->name }})</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.course-sub-categories.index', $courseCategory) }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-sub-categories.store', $courseCategory) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <div class="image-preview-box">
                                    <input type="file" name="icon" id="category-icon-upload" accept="image/*"
                                        class="form-control" />
                                    <img id="category-icon-preview" class="img-preview" alt="Logo Preview" src=""
                                        style="width: 170px; border-radius: 5px; margin-top: 20px; display: none" />
                                </div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12" style="display: flex; gap: 50px;">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="is_active">
                                    <span class="form-check-label">Is Active</span>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />

                                </label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1"
                                        name="is_trending">
                                    <span class="form-check-label">Is Trending</span>
                                    <x-input-error :messages="$errors->get('is_trending')" class="mt-2" />

                                </label>
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
