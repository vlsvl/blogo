<?php

namespace App\Jobs;

use App\Mail\SubscribeMail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscribeNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Post $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        //
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscribers = Subscriber::all(['email']);

        foreach($subscribers as $subscriber) {
            NewsAddedNotify::dispatch($subscriber->email, $this->post);
        }
    }
}
