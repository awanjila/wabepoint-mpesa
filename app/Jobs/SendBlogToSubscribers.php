<?php

namespace App\Jobs;

use App\Mail\BlogPublishedMail;
use App\Models\Blog;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBlogToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Blog $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function handle(): void
    {
        $subscribers = Subscriber::whereNotNull('email')->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->queue(new BlogPublishedMail($this->blog, $subscriber->name ?? 'Subscriber'));
        }
    }
}
