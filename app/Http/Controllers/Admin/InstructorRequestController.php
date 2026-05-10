<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AlertService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorRequestController extends Controller
{
    function index()
    {
        $instructor_requests = User::where('role', 'instructor')->paginate(20);
        return view('admin.dashboard.instructor-request.index', compact('instructor_requests'));
    }

    function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'approve_status' => 'required|in:pending,approved,rejected'
        ]);

        $user->update([
            'approve_status' => $request->approve_status
        ]);

        if ($user->approve_status == "approved") {

            $body = "
                <p>Hi there</p>

                <p>Your instructor request has been <strong>approved</strong>. From now you will be able to publish courses on our site!</p>

                <p>Please visit your dashboard from here:
                    <a href='" . url('/instructor/dashboard') . "'>Instructor Dashboard</a>
                </p>

                <p>Good luck!</p>
            ";

            MailService::sendAndQueue(
                to: $user->email,
                subject: "Instructor Request Approved",
                body: $body
            );
        } else if ($user->approve_status == "rejected") {

            $body = "
                <p>Hi there</p>

                <p>Your instructor request has been <strong>rejected</strong>.</p>

                <p>Sorry, but your application did not meet our requirements.</p>

                <p>You may try again later from your dashboard.</p>
            ";

            MailService::sendAndQueue(
                to: $user->email,
                subject: "Instructor Request Rejected",
                body: $body
            );
        }


        AlertService::updated('Approve Status Updated Successfully');

        return back();
    }

    public function download(User $user)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');
        return $disk->download($user->document);
    }
}
