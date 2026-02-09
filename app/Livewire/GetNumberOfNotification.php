<?php

namespace App\Livewire;

use Livewire\Component;

class GetNumberOfNotification extends Component
{
    public $unreadNotificationCount;

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        if (auth()->check()) {
        $this->unreadNotificationCount = auth()->user()->unreadNotifications()->count();
    } else {
        // 2. If guest, set count to 0 (No crash!)
        $this->unreadNotificationCount = 0;
    }
        
    }
    public function render()
    {
        return view('livewire.get-number-of-notification');
    }
}
