<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\AlertService;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    function index()
    {
        $withdraws = Withdraw::where('instructor_id', user()->id)->get();
        return view('frontend.instructor.dashboard.withdraw.index', compact('withdraws'));
    }

    function requestWithdraws()
    {
        $currentBallance = user()->wallet;
        $pendingBallance = Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->sum('amount');
        $totalPayout = Withdraw::where('instructor_id', user()->id)->where('status', 'approved')->sum('amount');
        return view('frontend.instructor.dashboard.withdraw.request', compact('currentBallance', 'pendingBallance', 'totalPayout'));
    }

    function storeRequestWithdraws(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        if (user()->wallet < $request->amount) {
            notyf()->error("Insufficient Balance!");
            return redirect()->back();
        }

        if (Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->exists()) {
            notyf()->error("Withdraw Request Already Pending!");
            return redirect()->back();
        }

        $amount = str_replace('.', '', $request->amount);

        $withdraw = new Withdraw();

        $withdraw->instructor_id = user()->id;

        $withdraw->amount = $amount;

        $withdraw->save();

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {

            Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_instructor_payout_request',
                'title' => 'New Payout Request',
                'message' => user()->name . ' submitted a payout request.',
                'url' => route('admin.withdraw-requests.index'),
                'icon' => 'ti ti-wallet',
                'color' => 'warning',
            ]);
        }

        AlertService::created('Withdraw reqeuest created');

        return to_route('instructor.withdraws.index');
    }
}
