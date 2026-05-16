@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Payout Gateway</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.payout-gateways.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payoutGateways as $gateway)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gateway->name }}</td>
                                    <td>
                                        @if ($gateway->status == 1)
                                            <span class="badge bg-success-lt">Active</span>
                                        @else
                                            <span class="badge bg-warning-lt">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.payout-gateways.edit', $gateway) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.payout-gateways.destroy', $gateway) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a type="submit" class="text-danger delete-btn"
                                                    data-name="{{ $gateway->name }}">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
