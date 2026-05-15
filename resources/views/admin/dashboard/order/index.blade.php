@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>{{ $order->customer->name }}</div>
                                        <small>{{ $order->customer->email }}</small>
                                    </td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ $order->paid_amount }}</td>
                                    <td>{{ $order->currency }}</td>
                                    <td>
                                        @if ($order->status == 'approved')
                                            <span class="badge bg-success-lt">Approved</span>
                                        @elseif ($order->status == 'pending')
                                            <span class="badge bg-warning-lt">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.orders.show', $order) }}">
                                                <i class="ti ti-eye"></i>
                                            </a>
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
