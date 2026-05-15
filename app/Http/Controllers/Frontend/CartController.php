<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index()
    {
        $cart = Cart::with(['course'])->where(['user_id' => user()->id])->paginate();
        return view('frontend.pages.cart', compact('cart'));
    }

    function add(int $id)
    {
        if (!Auth::check()) {
            return response([
                'message' => 'Please Login First!'
            ], 401);
        }

        if (Cart::where([
            'course_id' => $id,
            'user_id' => user()->id
        ])->exists()) {

            return response([
                'message' => 'Already Added!',
                'cartCount' => Cart::where('user_id', user()->id)->count()
            ], 401);
        }

        $course = Course::findOrFail($id);

        $cart = new Cart();
        $cart->course_id = $course->id;
        $cart->user_id = user()->id;
        $cart->save();

        return response([
            'message' => 'Added Successfully!',
            'cartCount' => Cart::where('user_id', user()->id)->count()
        ], 200);
    }

    function remove(int $id)
    {
        $cart = Cart::where(['id' => $id, 'user_id' => user()->id])->firstOrFail();
        $cart->delete();
        notyf()->success('Removed Successfully!');
        return redirect()->back();
    }
}
