@extends('frontend.layouts.app')


@section('content')
    <x-breadcrumb title="Checkout" />



    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="payment_area">
                        <p>Choose Your Payment Method</p>
                        <div class="row">
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="javascript:;" class="payment_mathod" id="midtrans-pay">
                                    <img src="{{ asset('assets/images/midtrans.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="total_payment_price">
                        <h4>Total Cart <span>({{ cartCount() }})</span></h4>
                        <ul>
                            <li>Subtotal :<span>{{ rupiah(cartTotal()) }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        $('#midtrans-pay').on('click', function() {

            $.ajax({

                url: "{{ route('midtrans.token') }}",

                method: "POST",

                data: {
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    if (!response.status) {

                        alert(response.message);
                        return;
                    }

                    snap.pay(response.snap_token, {

                        onSuccess: function(result) {

                            $.ajax({

                                url: "{{ route('midtrans.success') }}",

                                method: "POST",

                                data: {

                                    _token: "{{ csrf_token() }}",

                                    transaction_id: result.transaction_id,

                                    gross_amount: result.gross_amount
                                },

                                success: function() {

                                    window.location.href =
                                        "{{ route('payment.success') }}";
                                }
                            });
                        },

                        onPending: function(result) {

                            alert("Menunggu pembayaran");
                        },

                        onError: function(result) {

                            alert("Pembayaran gagal");
                        }

                    });
                }
            });

        });
    </script>
@endpush
