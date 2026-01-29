<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePostRquest;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        return view('dashboard', compact('user'));
    }
    public function displaySaved($name)
    {
        $user = auth()->user();
        return view('navigation-menu', compact('user'));
    }
    public function edit($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        if (auth()->id() !== $user->id) {
            abort(403, 'Unauthorized action.');
    }
        return view('profile.edit', compact('user'));
    }
}
