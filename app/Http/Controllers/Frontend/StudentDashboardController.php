<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUploadTrait;
    function index()
    {
        return view('frontend.student.dashboard.main.index');
    }

    function becomeInstructor()
    {
        return view('frontend.student.dashboard.become-instructor.index');
    }

    function becomeInstructorStore(Request $request)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12000']
        ]);

        $filePath = $this->uploadPrivateFile($request->file('document'));

        $user = user();

        $user->update([
            'approve_status' => 'pending',
            'role' => 'instructor',
            'document' => $filePath
        ]);

        AlertService::created('Instructor Request Submitted Successfully');

        return redirect()->route('instructor.dashboard.index');
    }

    function switchToInstructor()
    {
        $user = user();
        $user->role = 'instructor';
        $user->save();

        return redirect()->route('instructor.dashboard.index');
    }
}
