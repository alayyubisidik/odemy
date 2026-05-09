<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {

            $query->where('is_blocked', $request->status);
        }

        // Filter gender
        if ($request->filled('gender')) {

            $query->where('gender', $request->gender);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|in:admin,student,instructor',
        ]);

        // Default image
        $imagePath = '/uploads/default/avatar.png';

        // Upload image jika ada
        if ($request->hasFile('image')) {

            $imagePath = $this->uploadFile(
                $request->file('image'),
                null,
                'user-images'
            );
        }

        // Create user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'image' => $imagePath,
            'role' => $validated['role'],
        ]);

        AlertService::created();

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */ public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:3|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|in:admin,student,instructor',
            'is_blocked' => 'required|boolean',
        ]);

        // Upload image
        if ($request->hasFile('image')) {

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $user->image,
                'user-images'
            );
        }

        // Prevent self blocked
        $isBlocked = $user->id == Auth::user()->id
            ? $user->is_blocked
            : $validated['is_blocked'];

        // Update data
        $user->update([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => !empty($validated['password'])
                ? Hash::make($validated['password'])
                : $user->password,

            'image' => $validated['image'] ?? $user->image,

            'role' => $validated['role'],

            'is_blocked' => $isBlocked,
        ]);

        AlertService::updated();

        return redirect()->route('admin.users.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent self delete
        if ($user->id == Auth::user()->id) {

            AlertService::error('You cannot delete your own account.');

            return redirect()
                ->back();
        }

        // Delete image
        $this->deleteFile($user->image);

        // Delete user
        $user->delete();

        AlertService::deleted();

        return redirect()->route('admin.users.index');
    }
}
