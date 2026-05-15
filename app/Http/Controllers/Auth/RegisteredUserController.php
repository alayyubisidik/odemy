<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use FileUploadTrait;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:3', 'max:255'],
            'type' => ['required', 'in:student,instructor'],
        ];

        if ($request->type === 'instructor') {
            $rules['document'] = [
                'required',
                'file',
                'mimes:pdf,doc,docx,jpg,png',
                'max:12288' // 12MB
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('type', $request->type);
        }

        if ($request->type === "student") {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'approve_status' => 'pending'
            ]);
        } elseif ($request->type === 'instructor') {

            $filePath = $this->uploadPrivateFile($request->file('document'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'instructor',
                'approve_status' => 'pending',
                'document' => $filePath
            ]);
        } else {
            abort(404);
        }

        event(new Registered($user));
        Auth::login($user);

        return $user->role === 'student'
            ? redirect()->route('student.dashboard.index')
            : redirect()->route('instructor.dashboard.index');
    }
}
