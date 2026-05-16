@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
            <div class="wsus__dashboard_heading">
                <h5>Request Payout</h5>
                <p>Submit a request to withdraw your available earnings and track the payout process.</p>
            </div>
        </div>

        <div class="row " style="padding-left: 33px ">
            <div class="col-xl-4 col-sm-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="wsus__dash_earning">
                    <h6>Current Balance</h6>
                    <h3> {{ rupiah($currentBallance) }}</h3>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="wsus__dash_earning">
                    <h6>Pending Payout</h6>
                    <h3> {{ rupiah($pendingBallance) }}</h3>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="wsus__dash_earning">
                    <h6>Total Payout</h6>
                    <h3> {{ rupiah($totalPayout) }}</h3>
                </div>
            </div>
        </div>

        @if (user()->gatewayInformation)
            <table class="table" style="margin: 50px 0 33px 30px">
                <tr>
                    <td><b>Gateway</b></td>
                    <td>{{ user()->gatewayInformation->gateway }}</td>
                </tr>

                <tr>
                    <td><b>Gateway Information</b></td>
                    <td>{!! user()->gatewayInformation->gateway_information !!}</td>
                </tr>
            </table>
        @else
            <div class="alert alert-warning" style="margin:30px 0 20px 33px">
                You have not set up your payout gateway information yet.
                Please <a href="{{ route('instructor.profile.edit') }}">click here</a> to add your payout details
                before requesting a withdrawal.
            </div>
        @endif

        <form action="{{ route('instructor.withdraws.request.store') }}" method="post"
            class="wsus__dashboard_profile_update">
            @csrf

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__dashboard_profile_update_info">
                        <label>Payout Amount (RP)</label>
                        <x-input-error :messages="$errors->get('amount')" />
                        <input class="rupiah-input" name="amount" type="number" placeholder="Enter your amount" value="{{ old('amount') }}">
                    </div>
                </div>

                <div class="col-xl-12 mt-3">
                    <div class="wsus__dashboard_profile_update_btn">
                        <button type="submit" class="common_btn">Request</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('script')
    <script>
        $('.rupiah-input').on('input', function() {

            let value = $(this).val();

            value = value.replace(/[^0-9]/g, '');

            value = new Intl.NumberFormat('id-ID').format(value);

            $(this).val(value);
        });
    </script>
@endpush
