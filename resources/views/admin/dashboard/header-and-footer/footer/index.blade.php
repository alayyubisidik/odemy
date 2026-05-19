@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Footer Management</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.footers.store') }}" method="post" >
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description"
                                    value="{{ old('description', $footer?->description) }}">
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="copyright">Copyright</label>
                                <input type="text" class="form-control" name="copyright" id="copyright"
                                    value="{{ old('copyright', $footer?->copyright) }}">
                                <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ old('phone', $footer?->phone) }}">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label required" for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email', $footer?->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    value="{{ old('address', $footer?->address) }}">
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
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
