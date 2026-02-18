<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public $post;
    public $isLiked;

    public function mount(Post $post)
    {
        $this->post = $post;

        if (Auth::check()) 
        {
            $this->isLiked = Auth::user()->likedPost()->where('post_id', $post->id)->exists();
        } 
        else 
        {
            $this->isLiked = false;
        }
    }

    public function like()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        try 
        {
            auth()->user()->likedPost()->attach($this->post->id);
            $this->isLiked = true;
        } catch (\Illuminate\Database\QueryException $e) 
        {
            // Like already exists, ignore
            $this->isLiked = true;

        }
    }

    public function unlike()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        auth()->user()->likedPost()->detach($this->post->id);
        $this->isLiked = false;
    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
