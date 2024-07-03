<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class SendNewPostNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    use InteractsWithQueue;

    public function handle(PostCreated $event)
    {
        $post = $event->post;
        $item = $post->item;

        $followers = $item->followers()->get();

        foreach ($followers as $follower) {
            Notification::send($follower, new EmailNotification($post));
        }
    }
}
