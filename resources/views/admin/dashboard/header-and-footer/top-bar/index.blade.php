@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top Bar Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.top-bars.store') }}" method="post" >
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email', $topBar?->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ old('phone', $topBar?->phone) }}">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="offer_name">Offer Name</label>
                                <input type="text" class="form-control" name="offer_name" id="offer_name"
                                    value="{{ old('offer_name', $topBar?->offer_name) }}">
                                <x-input-error :messages="$errors->get('offer_name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="offer_short_description">Offer Short Description</label>
                                <input type="text" class="form-control" name="offer_short_description" id="offer_short_description"
                                    value="{{ old('offer_short_description', $topBar?->offer_short_description) }}">
                                <x-input-error :messages="$errors->get('offer_short_description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="offer_button_text">Offer Button Text</label>
                                <input type="text" class="form-control" name="offer_button_text" id="offer_button_text"
                                    value="{{ old('offer_button_text', $topBar?->offer_button_text) }}">
                                <x-input-error :messages="$errors->get('offer_button_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label required" for="offer_button_url">Offer Button URL</label>
                                <input type="text" class="form-control" name="offer_button_url" id="offer_button_url"
                                    value="{{ old('offer_button_url', $topBar?->offer_button_url) }}">
                                <x-input-error :messages="$errors->get('offer_button_url')" class="mt-2" />
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
