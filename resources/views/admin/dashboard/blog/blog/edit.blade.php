@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog Edit</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blogs.update', $blog) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Image </label>
                                <x-input-error :messages="$errors->get('image')" />
                                <div class="image-preview-box">
                                    <input type="file" name="image" id="image-upload-one" accept="image/*"
                                        class="form-control" />
                                    <img name="image" id="image-preview-one" class="img-preview" alt="Logo Preview"
                                        src="{{ asset($blog?->image) }}"
                                        style="width: 200px; border-radius: 5px; margin-top: 20px;  {{ $blog?->image ? '' : 'display: none' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $blog->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug', $blog->slug) }}">
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="blog_category_id">Category</label>

                                <x-input-error :messages="$errors->get('blog_category_id')" />

                                <select name="blog_category_id" id="blog_category_id" class="form-select">
                                    @foreach ($blog_categories as $blog_category)
                                        <option value="{{ $blog_category->id }}"
                                            {{ old('blog_category_id', $blog->blog_category_id) == $blog_category->id ? 'selected' : '' }}>
                                            {{ $blog_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="description">Description</label>
                                <textarea name="description" id="editor" class="form-control">{{ old('description', $blog->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" value="1" name="status"
                                        @checked($blog->status)>
                                    <span class="form-check-label">Active</span>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
