<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    function index() {
        return view('frontend.pages.checkout');
    }
}
