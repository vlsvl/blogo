<?php

namespace App\Http\Controllers\Public;

use App\Events\Hello;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|max:255',
            'post_id' => 'integer|required|exists:posts,id',
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'content' => $validated['content'],
            'post_id' => $validated['post_id'],
        ]);

        Hello::broadcast($validated['content']);

        return redirect()->back();
    }
}
