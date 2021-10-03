<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\Website;
use App\Mail\NewPostMail;

class SendPostMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $website_id= $event->post->website_id;
        $website = Website::find($website_id);
        foreach ($website->subscribers as $subscriber) {
            Mail::to($subscriber)
            ->queue(new NewPostMail($event->post));
        }
    }
}
