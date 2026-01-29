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
        $this->unreadNotificationCount = auth()->user()->unreadNotifications()->count();
    }
    public function render()
    {
        return view('livewire.get-number-of-notification');
    }
}
