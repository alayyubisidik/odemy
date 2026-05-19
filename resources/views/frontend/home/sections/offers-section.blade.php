    <section class="wsus__offer" style="background: url({{ asset('assets/frontend/dist/images/offer_bg.jpg') }});">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-4 col-md-6 wow fadeInLeft">
                    <div class="wsus__offer_img">
                        <img src="{{ asset('assets/frontend/dist/images/offer_img_1.png') }}" alt="Offer"
                            class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 wow fadeInRight">
                    <div class="wsus__offer_text">
                        <h2>Eager to Receive Special Offers & Updates on Courses?</h2>
                        <form action="#" method="post" class="newsletter-form">
                            @csrf
                            <input type="email" placeholder="Your email address..." required name="email">
                            <button type="submit" class="common_btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script>
            $('.newsletter-form').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('newsletters') }}",
                    method: 'POST',
                    data: formData,
                    success: function(data) {

                        notyf.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        let errorMessage = xhr.responseJSON.message;
                        notyf.error(errorMessage);
                    }
                });

            })
        </script>
    @endpush
