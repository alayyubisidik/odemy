@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Counter Section Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.counter-sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="counter_one">Counter One</label>
                                <input type="text" class="form-control" name="counter_one" id="counter_one"
                                    value="{{ old('counter_one', $counter_section?->counter_one) }}">
                                <x-input-error :messages="$errors->get('counter_one')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_one">Title One</label>
                                <input type="text" class="form-control" name="title_one" id="title_one"
                                    value="{{ old('title_one', $counter_section?->title_one) }}">
                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="counter_two">Counter Two</label>
                                <input type="text" class="form-control" name="counter_two" id="counter_two"
                                    value="{{ old('counter_two', $counter_section?->counter_two) }}">
                                <x-input-error :messages="$errors->get('counter_two')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_two">Title Two</label>
                                <input type="text" class="form-control" name="title_two" id="title_two"
                                    value="{{ old('title_two', $counter_section?->title_two) }}">
                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="counter_three">Counter Three</label>
                                <input type="text" class="form-control" name="counter_three" id="counter_three"
                                    value="{{ old('counter_three', $counter_section?->counter_three) }}">
                                <x-input-error :messages="$errors->get('counter_three')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_three">Title Three</label>
                                <input type="text" class="form-control" name="title_three" id="title_three"
                                    value="{{ old('title_three', $counter_section?->title_three) }}">
                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="counter_four">Counter Four</label>
                                <input type="text" class="form-control" name="counter_four" id="counter_four"
                                    value="{{ old('counter_four', $counter_section?->counter_four) }}">
                                <x-input-error :messages="$errors->get('counter_four')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="title_four">Title Four</label>
                                <input type="text" class="form-control" name="title_four" id="title_four"
                                    value="{{ old('title_four', $counter_section?->title_four) }}">
                                <x-input-error :messages="$errors->get('title_four')" class="mt-2" />
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
