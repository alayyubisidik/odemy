@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">

        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
            <div class="wsus__dashboard_heading ">
                <h5>Withdraw Request</h5>
                <p>Manage your withdrawal requests and track their status such as pending, approved, and rejected.</p>
            </div>
            <div class="wsus__dashboard_contant_btn">
                <a href="{{ route('instructor.withdraws.request') }}" class="common_btn">Request Payout</a>
            </div>
        </div>


        <div class="wsus__dash_course_table">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th class="sale">
                                        Status
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                                @forelse($withdraws as $withdraw)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ rupiah( $withdraw->amount ) }}</td>

                                        <td>
                                            @if ($withdraw->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($withdraw->status == 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($withdraw->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>

                                        <td>{{ $withdraw->created_at->format('d M Y') }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No withdrawal requests found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
