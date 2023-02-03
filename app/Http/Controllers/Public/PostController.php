<?php

namespace App\Http\Controllers\Public;

use App\Events\Hello;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Public/Index', [
            'posts' => Post::with('user')
                ->withCount('comments')
                ->latestDesc()
                ->posted()
                ->paginate(10)
                ->through(fn ($post) => [
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->getFirstParagraph(),
                    'posted_at' => $post->posted_at->format('d.m.Y'),
                    'user' => [
                        'id' => $post->user->id,
                        'name' => $post->user->name,
                    ],
                    'comments_count' => $post->comments_count,
                ])
        ]);
    }

    public function show(Request $request, Post $post)
    {
        $post->loadMorph('tags', [
            Post::class => 'tag_id'
        ]);
        return Inertia::render('Public/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'posted_at' => $post->posted_at->format('d.m.Y'),
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                ],
                'tags' => $post->tags,
            ],
            'comments' => Comment::where('post_id', $post->id)
                ->with('user')
                ->get()
                ->map(fn($comment) => [
                    'user_name' => $comment->user->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->format('d.m.Y'),
                ])
        ]);
    }
}
