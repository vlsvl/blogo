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
                ->latestDesc()
                ->paginate(10)
                ->through(fn ($post) => [
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'posted_at' => $post->posted_at->format('d.m.Y'),
                    'user' => $post->user,
                ])
        ]);
    }
}
