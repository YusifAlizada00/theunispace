<?php

namespace App\Livewire;

use App\Models\LikedPost;
use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class LikeList extends Component
{
    public $user;
    
    public function mount($user)
    {
        $this->user = $user;
    }

    public function getLikedUsers(Post $post)
    {
        // If you wanna add more filtering on likedUsers then you do likedUsers() 
        $users = $post->likedUsers;
        return view('livewire.like-list', compact('users', 'post'));
    }

    public function render()
    {
        return view('livewire.like-list');
    }
}
