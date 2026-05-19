@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Course Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.latest-course-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <select name="category_one" id="category_one" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_one', $latestCourseSection ? $latestCourseSection->category_one : '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_one')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <select name="category_two" id="category_two" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_two', $latestCourseSection ? $latestCourseSection->category_two : '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_two')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <select name="category_three" id="category_three" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_three', $latestCourseSection ? $latestCourseSection->category_three : '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_three')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <select name="category_four" id="category_four" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_four', $latestCourseSection ? $latestCourseSection->category_four : '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_four')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <select name="category_five" id="category_five" class="form-select">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->isNotEmpty())
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('category_five', $latestCourseSection ? $latestCourseSection->category_five : '') == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_five')" class="mt-2" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
