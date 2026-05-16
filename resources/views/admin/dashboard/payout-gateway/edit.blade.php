@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Payout Gateway</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.payout-gateways.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payout-gateways.update', $payoutGateway) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $payoutGateway->name) }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1"
                                        {{ old('status', $payoutGateway->status) === 1 ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('status', $payoutGateway->status) === 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label required" for="description">Description</label>
                                <textarea name="description" id="short-editor">{{ old('description', $payoutGateway->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" />
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
