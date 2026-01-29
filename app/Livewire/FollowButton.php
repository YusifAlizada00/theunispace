<?php

namespace App\Livewire;

use App\Events\UserFollowedEvent;
use App\Mail\NewNotificationEmail;
use App\Notifications\UserFollowedNotification;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserUnfollowedNotification;
use Illuminate\Support\Facades\Mail;


class FollowButton extends Component
{
    public $user;
    public $isFollowing;
    

    public function mount(User $user)
    {
        //$this in here means take the passed user from parent (livewire component) and assign it to $user
        $this->user = $user;
        $this->isFollowing = Auth::user()->following->contains($user->id);
    }

    public function follow()
    {
        $follower = Auth::user();

        if (! $follower->following->contains($this->user->id)) {
            $follower->following()->attach($this->user->id);
            $this->user->notify(new UserFollowedNotification($follower));
            Mail::to($this->user->email)->send(new NewNotificationEmail($this->user, $this->user->unreadNotifications->count()));
        }
        
        $this->isFollowing = true;
    }

    public function unfollow()
    {
        $follower = Auth::user();

        if ($follower->following->contains($this->user->id)) {
            $follower->following()->detach($this->user->id);
            $this->user->notify(new UserUnfollowedNotification($follower));
            Mail::to($this->user->email)->send(new NewNotificationEmail($this->user, $this->user->unreadNotifications->count()));
        }
        
        $this->isFollowing = false;
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
