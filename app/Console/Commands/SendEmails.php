<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostMail;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Posts to the Subscribers By Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where('status', null)->get();

        foreach ($posts as $post) {
            $website_id= $post->website_id;
            $website = Website::find($website_id);
            foreach ($website->subscribers as $subscriber) {
                Mail::to($subscriber)
                ->queue(new NewPostMail($post));
            }
            $post->status='sent';
            $post->save();
        }

        $this->info('Sending Posts to the Subscribers By Command!');
        return 0;
    }
}
