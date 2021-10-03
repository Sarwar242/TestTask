<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class NewPostMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $post;
    protected $website;
    public function __construct(Post $post)
    {
        $this->post = $post;
        // info($this->post);
        if($post->website)
            $this->website= $post->website->link;
        // info($this->website);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@test.com', 'WebsitePoster')
                    ->view('emails.post')
                    ->with([
                        'post'=> $this->post,
                        'website' => $this->website,
                    ]);
    }
}
