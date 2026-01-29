<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewFollowingPostEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $follower;
    public $post;
    public $url;

    public function __construct($follower, $post, $url)
    {
        $this->follower = $follower; // the person being followed
        $this->post = $post;           // their post
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Post From Someone You Follow',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.post-alert',
            with: [
                'followerName' => $this->follower->name,
                'url' => $this->url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
