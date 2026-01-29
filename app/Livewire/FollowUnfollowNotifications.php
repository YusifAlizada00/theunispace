<?php

namespace App\Livewire;

use Livewire\Component;

class FollowUnfollowNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        // Fetch all notifications (or just unread if you prefer)
        $this->notifications = auth()->user()
            ->notifications() // all notifications
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.follow-unfollow-notifications');
    }
}
