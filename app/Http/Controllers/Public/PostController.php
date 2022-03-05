<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Public/Index', [
            'posts' => Post::with('user')
                ->latest()
                ->posted()
                ->paginate(10)
                ->through(fn ($post) => [
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'posted_at' => $post->posted_at->format('d.m.Y'),
                    'user' => [
                        'id' => $post->user->id,
                        'name' => $post->user->name,
                    ],
                ])
        ]);
    }

    public function show(Request $request, Post $post)
    {
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
            ],
        ]);
    }
}
