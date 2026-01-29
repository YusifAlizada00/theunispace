<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UrgentReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $reporter;
    public $post;
    public $reasons;
    public $additionalInfo;
    public $url;
    public function __construct($reporter, $post, $reasons, $additionalInfo, $url)
    {
        $this->reporter = $reporter;
        $this->post = $post;
        $this->reasons = $reasons;
        $this->additionalInfo = $additionalInfo;
        $this->url = $url;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Urgent Report Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.urgent-report-email',
            with: [
                'post' => $this->post,
                'reporter' => $this->reporter,
                'reasons' => $this->reasons,
                'additionalInfo' => $this->additionalInfo,
                'url' => $this->url
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
