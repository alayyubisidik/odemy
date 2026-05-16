@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Withdraw Request</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Instructor</th>
                                <th>Payout Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdraws as $withdraw)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $withdraw->instructor->name }}</td>
                                    <td>{{ $withdraw->amount }}</td>
                                    <td>
                                        @if ($withdraw->status == 'approved')
                                            <span class="badge bg-success-lt">Approved</span>
                                        @elseif ($withdraw->status == 'pending')
                                            <span class="badge bg-warning-lt">Pending</span>
                                        @elseif ($withdraw->status == 'rejected')
                                            <span class="badge bg-danger-lt">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.withdraw-requests.show', $withdraw) }}">
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
                    {{ $withdraws->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
