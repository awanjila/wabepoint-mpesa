<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlogPublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Blog $blog;
    public string $subscriberName;

    public function __construct(Blog $blog, string $subscriberName)
    {
        $this->blog = $blog;
        $this->subscriberName = $subscriberName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->blog->name . ' - WabePoint Blog',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.blog-published',
            with: [
                'blog' => $this->blog,
                'name' => $this->subscriberName,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
