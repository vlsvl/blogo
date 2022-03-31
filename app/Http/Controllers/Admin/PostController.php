<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Filters\PostFilter;
use App\Models\Post;
use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(PostFilter $request): \Inertia\Response
    {
        return Inertia::render(
            'Admin/Posts/Index', [
            'filters' => $request->getQuery(['search']),
            'posts' => Post::orderBy('updated_at', 'desc')
                ->select(['id', 'title', 'slug', 'updated_at', 'posted_at', 'user_id'])
                ->with('user')
                ->filter($request)
                ->paginate(10)
                ->withQueryString()
                ->through(
                    fn ($post) => [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'posted_at' => $post->posted_at ? $post->posted_at->format('d.m.Y') : '',
                        'updated_at' => $post->updated_at->format('d.m.Y'),
                        'user' => $post->user->name,
                    ]
                ),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Admin/Posts/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request): \Illuminate\Http\RedirectResponse
    {
       $post = Post::create($request->validated());

       if ($newTags = $request->get('tags')) {
           $tags = [];
           foreach ($newTags as  $tag) {
               $tags[] = Tag::firstOrCreate(['name' => $tag['name']])->id;
           }

           $post->tags()->sync($tags);
       }

       return redirect()->route('posts.index')
           ->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect()->route('public.post.show', $post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Inertia\Response
     */
    public function edit(Post $post): \Inertia\Response
    {
        $post->loadMorph('tags', [
            Post::class => 'tag_id'
        ]);
        return Inertia::render(
            'Admin/Posts/CreateUpdate',
            [
                'post' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'posted_at' => $post->posted_at ? $post->posted_at->format('d.m.Y') : '',
                    'user' => $post->user->name,
                    'tags' => $post->tags()->get()->map->only(['id', 'name']),
                ]
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $data= $request->validated();
        $post->update($data);

        $tags = [];
        foreach ($request->get('tags') as  $tag) {
            $tags[] = Tag::firstOrCreate(['name' => $tag['name']])->id;
        }

        $post->tags()->sync($tags);

        return redirect()->route('posts.index')
            ->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
