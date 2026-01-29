<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCommentedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $commenter;
    public $post;
    public function __construct($commenter, $post)
    {
        $this->commenter = $commenter;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'commenter_name' => $this->commenter->name,
            'post_slug' => $this->post->slug,
            'commenter_id' => $this->commenter->id,
        ];
    }
}
