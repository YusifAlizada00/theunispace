<?php

namespace App\Livewire;

use Livewire\Component;

class MarkAsRead extends Component
{


    public $notificationId;
    public $isClicked = false;

    public function mount($notificationId)
    {
        $this->notificationId = $notificationId;

        $notification = auth()->user()->notifications()->find($notificationId);
        $this->isClicked = $notification ? $notification->read_at !== null : false;
    }

    public function markNotificationAsRead()
    {
        $notification = auth()->user()->notifications()->find($this->notificationId);

        if ($notification) {
            $notification->markAsRead();
            $this->isClicked = true;
        }
    }

    
    
    public function render()
    {
        return view('livewire.mark-as-read');
    }
}
