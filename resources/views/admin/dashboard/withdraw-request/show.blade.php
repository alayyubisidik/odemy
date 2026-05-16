@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Withdraw Request Detail</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <tr>
                            <td><b>Instructor</b></td>
                            <td>
                                <p>{{ $withdraw->instructor->name }}</p>
                                <p>{{ $withdraw->instructor->email }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Gateway</b></td>
                            <td>
                                <p>{{ $withdraw->instructor->gatewayInformation->gateway }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Gateway Information</b></td>
                            <td>
                                <p>{{ $withdraw->instructor->gatewayInformation->gateway_information }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Current Wallet Balance</b></td>
                            <td>
                                <p>{{ rupiah($withdraw->instructor->wallet) }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Payout Amount</b></td>
                            <td>{{ rupiah($withdraw->amount) }}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>
                                @if ($withdraw->status == 'approved')
                                    <span class="badge bg-success-lt">Approved</span>
                                @elseif ($withdraw->status == 'pending')
                                    <span class="badge bg-warning-lt">Pending</span>
                                @elseif ($withdraw->status == 'rejected')
                                    <span class="badge bg-danger-lt">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Action</b></td>
                            <td>

                                @if ($withdraw->status == 'pending')
                                    <div class="alert alert-warning">
                                        Status withdraw request tidak bisa diubah setelah diperbarui.
                                    </div>
                                @endif

                                <br>

                                <form action="{{ route('admin.withdraw-requests.update', $withdraw->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div>

                                        <select name="status" class="form-control" style="max-width:180px;"
                                            {{ $withdraw->status !== 'pending' ? 'disabled' : '' }}>
                                            <option value="pending" {{ $withdraw->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="approved"
                                                {{ $withdraw->status == 'approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>

                                            <option value="rejected"
                                                {{ $withdraw->status == 'rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>
                                        </select>

                                        <br>

                                        <button type="submit" class="btn btn-primary"
                                            {{ $withdraw->status !== 'pending' ? 'disabled' : '' }}>
                                            Update
                                        </button>

                                    </div>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
