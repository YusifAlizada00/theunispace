<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function getFollowers($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        $followers = $user->followers()->get();
        return view("profile.followers-list", compact("followers"));
    }

    public function getFollowings($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        $followings = $user->following()->get();
        return view("profile.followings-list", compact("followings"));
    }
}
