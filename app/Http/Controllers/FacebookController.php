<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;


class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        // Try to find user by facebook_id first
        $user = User::where('facebook_id', $facebookUser->getId())->first();

        if (!$user) {
            // Or by email if no facebook_id
            $user = User::where('email', $facebookUser->getEmail())->first();
        }

        if ($user) {
            // Update facebook_id and mark email verified
            $user->update([
                'facebook_id' => $facebookUser->getId(),
                'email_verified_at' => now(),
                'profile_photo_path' => $facebookUser->getAvatar(),
            ]);
        } else {
            // Create new user
            $baseSlug = Str::slug($facebookUser->getName());
            $slug = $baseSlug;
            $count = User::where('slug', 'LIKE', "{$baseSlug}%")->count();
            if ($count)
                $slug = "{$baseSlug}-" . ($count + 1);

            $user = User::create([
                'name' => $facebookUser->getName(),
                'slug' => $slug,
                'email' => $facebookUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'profile_photo_path' => $facebookUser->getAvatar(),
                'facebook_id' => $facebookUser->getId(),
                'email_verified_at' => now(),
            ]);
        }


        Auth::login($user);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user, true);


        return redirect('/');
    }
}
