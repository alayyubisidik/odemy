@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Blog Category</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-categories.store') }}" method="post" >
                    @csrf
                    <div class="row">

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
                                <label class="form-label required" for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-4">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" checked="" value="1"
                                        name="status" {{ old('status', 1) ? 'checked' : '' }}>
                                    <span class="form-check-label">Active</span>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
