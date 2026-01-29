<?php
namespace App\Events; 
use Illuminate\Broadcasting\Channel; 
use Illuminate\Broadcasting\InteractsWithSockets; 
use Illuminate\Broadcasting\PrivateChannel; 
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; 
use Illuminate\Foundation\Events\Dispatchable; 
use Illuminate\Queue\SerializesModels; 
use Illuminate\Notifications\DatabaseNotification; 

class NotificationRead implements ShouldBroadcast 
{ 
    use Dispatchable, InteractsWithSockets, SerializesModels; 

    public $notification; 

    public function __construct(DatabaseNotification $notification) 
    { 
        $this->notification = $notification; 
    } 
    
    public function broadcastOn(): PrivateChannel 
    {  
        return new PrivateChannel('App.Models.User.' . $this->notification->notifiable_id); 
    } 
    
    public function broadcastWith() 
    { 
        return [ 
            'id' => $this->notification->id, 
            'read_at' => $this->notification->read_at, 
        ]; 
    } 
}