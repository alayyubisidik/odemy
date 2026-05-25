<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Enrollment;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Midtrans\Config;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function generateToken()
    {
        $user = user();

        $cartItems = Cart::with('course')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {

            return response()->json([
                'status' => false,
                'message' => 'Cart kosong'
            ]);
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $items = [];
        $total = 0;

        foreach ($cartItems as $item) {

            $price = $item->course->discount > 0
                ? $item->course->discount
                : $item->course->price;

            $items[] = [
                'id' => $item->course->id,
                'price' => (int)$price,
                'quantity' => 1,
                'name' => $item->course->title,
            ];

            $total += $price;
        }

        $orderId = 'ORDER-' . time() . '-' . $user->id;

        $params = [

            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int)$total,
            ],

            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],

            'item_details' => $items,
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'status' => true,
            'snap_token' => $snapToken
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $user = user();

        DB::beginTransaction();

        try {

            $cartItems = Cart::with('course.instructor')
                ->where('user_id', $user->id)
                ->get();

            if ($cartItems->isEmpty()) {

                return response()->json([
                    'status' => false,
                    'message' => 'Cart kosong'
                ]);
            }

            $order = new Order();

            $order->invoice_id = uniqid();

            $order->buyer_id = $user->id;

            $order->status = 'approved';

            $order->total_amount = $request->gross_amount;

            $order->paid_amount = $request->gross_amount;

            $order->payment_method = 'midtrans';

            $order->transaction_id = $request->transaction_id;

            $order->save();

            foreach ($cartItems as $item) {

                $price = $item->course->discount > 0
                    ? $item->course->discount
                    : $item->course->price;

                /** ORDER ITEM */
                $orderItem = new OrderItem();

                $orderItem->order_id = $order->id;

                $orderItem->course_id = $item->course->id;

                $orderItem->commission_rate = (int) config('settings.commission_rate');

                $orderItem->qty = 1;

                $orderItem->price = $price;

                $orderItem->save();

                /** ENROLLMENT */
                $enrollment = new Enrollment();

                $enrollment->user_id = $user->id;

                $enrollment->course_id = $item->course->id;

                $enrollment->instructor_id =
                    $item->course->instructor_id;

                $enrollment->save();

                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'student_enrollment_successful',
                    'title' => 'Enrollment Successful',
                    'message' => 'You have successfully enrolled in ' . $item->course->title,
                    'url' => route('student.my-learning.index'),
                    'icon' => 'ti ti-book',
                    'color' => 'success',
                ]);

                Notification::create([
                    'user_id' => $item->course->instructor_id,
                    'type' => 'instructor_new_enrollment',
                    'title' => 'New Enrollment',
                    'message' => $user->name . ' enrolled in your course ' . $item->course->title,
                    'url' => route('instructor.dashboard.index'),
                    'icon' => 'ti ti-user-plus',
                    'color' => 'primary',
                ]);

                /** INSTRUCTOR WALLET */
                $instructor = $item->course->instructor;

                $commission =
                    ($price * (int) config('settings.commission_rate')) / 100;

                $instructor->wallet += ($price - $commission);

                $instructor->save();
            }

            /** DELETE CART */
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'status' => true
            ]);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
