<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowingPostedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $follower;
    public $post;
    public function __construct($follower, $post)
    {
        $this->follower = $follower;
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
        'follower_name' => $this->follower->name,
        'post_title' => $this->post['title'],
        'post_slug' => $this->post['slug'],
        ];
    }
}
