<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        /** @var \App\Models\User $user */
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
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('instructor.dashboard.index');
    }

    function profile()
    {
        $user = user();
        return view('frontend.student.dashboard.profile.index', compact('user'));
    }

    function profileEdit()
    {
        return view('frontend.student.dashboard.profile.edit');
    }

    function profileUpdate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'bio' => 'nullable|string|max:1000',
            "image" => ["nullable", "image", "max:2048"],
            // Contoh social media links, jika ada
            'facebook' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'x' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Ambil user yang sedang login
        $user = user();

        if ($request->hasFile("image")) {
            $validated['image'] = $this->uploadFile($request->file("image"), $user->image, "user-images");
        }

        // Update data user
        /** @var \App\Models\User $user */
        $user->update($validated);

        AlertService::updated("Profile Updated Successfully");

        return back();
    }

    function passwordUpdate(Request $request)
    {
        $user = user();

        // Validasi
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:3|confirmed', // harus ada password_confirmation
        ]);

        // Update email
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        /** @var \App\Models\User $user */
        $user->save();

        // Notifikasi sukses
        AlertService::updated("Password or Email Updated Successfully");

        return back();
    }
}
