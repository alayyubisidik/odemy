<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Withdraw;
use App\Services\AlertService;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    function index()
    {
        $withdraws = Withdraw::with('instructor')->paginate(25);
        return view('admin.dashboard.withdraw-request.index', compact('withdraws'));
    }

    function withdrawShow(Withdraw $withdraw)
    {
        return view('admin.dashboard.withdraw-request.show', compact('withdraw'));
    }

    public function withdrawUpdate(Withdraw $withdraw, Request $request)
    {
        if ($withdraw->status != 'pending') {

            AlertService::error('Status withdraw request tidak bisa diubah lagi!');

            return redirect()->back();
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $withdraw->status = $request->status;

        if ($request->status == 'approved') {

            $withdraw->instructor->wallet =
                ($withdraw->instructor->wallet - $withdraw->amount);

            $withdraw->instructor->save();
        }

        $withdraw->save();
        if ($request->status == 'approved') {

            Notification::create([
                'user_id' => $withdraw->instructor_id,
                'type' => 'instructor_payout_approved',
                'title' => 'Payout Approved',
                'message' => 'Your payout request has been approved.',
                'url' => route('instructor.withdraws.index'),
                'icon' => 'ti ti-circle-check',
                'color' => 'success',
            ]);
        }

        if ($request->status == 'rejected') {

            Notification::create([
                'user_id' => $withdraw->instructor_id,
                'type' => 'instructor_payout_rejected',
                'title' => 'Payout Rejected',
                'message' => 'Your payout request has been rejected.',
                'url' => route('instructor.withdraws.index'),
                'icon' => 'ti ti-circle-x',
                'color' => 'danger',
            ]);
        }

        AlertService::created("Updated Successfully!");

        return redirect()->route('admin.withdraw-requests.index');
    }
}
