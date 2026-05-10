<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $google */
        $google = Socialite::driver('google');

        return $google
            ->stateless()
            ->redirect();
    }

    public function callback()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $google */
        $google = Socialite::driver('google');

        $socialUser = $google->stateless()->user();

        $user = User::firstOrCreate(
            [
                'google_id' => $socialUser->id,
            ],
            [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => bcrypt(Str::random(16)),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
                'role' => 'student', // hanya untuk user BARU
            ]
        );

        // update token saja (jangan role)
        $user->update([
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user);

        if ($user->role == 'student') {
            return redirect()->route('student.dashboard.index');
        } elseif ($user->role == 'instructor') {
            return redirect()->route('instructor.dashboard.index');
        } elseif ($user->role == 'admin') {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->route('student.dashboard.index'); // fallback aman
    }
}
