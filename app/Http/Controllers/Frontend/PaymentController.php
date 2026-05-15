<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    function paymentSuccess()
    {
        return view("frontend.pages.payment-success");
    }

    function paymentCancel()
    {
        return view("frontend.pages.payment-cancel");
    }
}
