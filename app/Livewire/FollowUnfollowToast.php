<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FollowUnfollowToast extends Component
{
    public $notifications = [];
    public $displayedIds = [];
    public $pageLoadedAt;

    public function mount()
    {
        // Track when the page was loaded
        $this->pageLoadedAt = now();
    }

    public function loadLatest()
    {
        $latest = Auth::user()->notifications()
            ->whereIn('type', [
                'App\Notifications\UserFollowedNotification',
                'App\Notifications\UserUnfollowedNotification'
            ])
            // In here, we only want to show up the notifications that were created after the page was loaded 
            // because if there are 50 notifications before user enters the page, we don't want to show all those as toasts
            ->where('created_at', '>', $this->pageLoadedAt) // only new notifications
            ->latest()
            ->get();

        foreach ($latest as $notification) {
            // This checks if the notification is already displayed
            if (!in_array($notification->id, $this->displayedIds)) {
                $this->notifications[] = $notification;
                $this->displayedIds[] = $notification->id;
            }
        }
    }

    public function render()
    {
        return view('livewire.follow-unfollow-toast');
    }
}
