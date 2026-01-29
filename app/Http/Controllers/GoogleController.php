<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Try to find user by google_id first
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // Or by email if no google_id
            $user = User::where('email', $googleUser->getEmail())->first();
        }

        if ($user) {
            // Update google_id and mark email verified
            $user->update([
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
                'profile_photo_path' => $googleUser->getAvatar(),
            ]);
        } else {
            // Create new user
            $baseSlug = Str::slug($googleUser->getName());
            $slug = $baseSlug;
            $count = User::where('slug', 'LIKE', "{$baseSlug}%")->count();
            if ($count)
                $slug = "{$baseSlug}-" . ($count + 1);

            $user = User::create([
                'name' => $googleUser->getName(),
                'slug' => $slug,
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'profile_photo_path' => $googleUser->getAvatar(),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }


        return redirect('/');
    }

}
