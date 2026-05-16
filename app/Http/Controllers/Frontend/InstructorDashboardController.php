<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InstructorGatewayInformation;
use App\Models\OrderItem;
use App\Models\PayoutGateway;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorDashboardController extends Controller
{
    use FileUploadTrait;
    function index()
    {
        return view('frontend.instructor.dashboard.main.index');
    }

    function profile()
    {
        $user = user();
        $gatewayInfo = user()->gatewayInformation()->first();
        $gateways = PayoutGateway::all();
        return view('frontend.instructor.dashboard.profile.edit', compact('user', 'gateways', 'gatewayInfo'));
    }

    function profileEdit()
    {
        // $gatewayInfo = user()->gatewayInformation()->first();
        // $gateways = PayoutGateway::all();
        return view('frontend.instructor.dashboard.profile.edit');
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

    function switchToStudent()
    {
        $user = user();
        $user->role = 'student';
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('student.dashboard.index');
    }

    function orderIndex()
    {
        $orderItems = OrderItem::whereHas('product', function ($query) {
            $query->where('instructor_id', user()->id);
        })->paginate(25);

        return view('frontend.instructor.dashboard.order.index', compact('orderItems'));
    }

    function storeGatewayInformation(Request $request)
    {
        $validated = $request->validate([
            'gateway' => ['required', 'string', 'max:255'],
            'gateway_information' => ['required', 'string']
        ]);

        InstructorGatewayInformation::updateOrCreate(
            [
                'instructor_id' => user()->id
            ],
            [
                'gateway' => $validated['gateway'],
                'gateway_information' => $validated['gateway_information']
            ]
        );

        return back()->with('success', 'Gateway information updated successfully');
    }
}
