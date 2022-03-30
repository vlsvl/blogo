<?php

namespace App\Jobs;

use App\Mail\NewPostMail;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewsAddedNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $to;
    private Post $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $to, Post $post)
    {
        //
        $this->to = $to;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new NewPostMail($this->post));
    }
}
