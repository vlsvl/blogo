<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filters\PostFilter;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $result = [];
        $result['posts'] = Post::where('title', 'like', '%'.$request->get('query').'%')
            ->orWhere('content', 'like', '%'.$request->get('query').'%')
            ->limit(10)
            ->get();
        if ($request->user()->isAdmin()) {
            $result['users'] = User::where('name', 'like', '%'.$request->get('query').'%')
                ->orWhere('email', 'like', '%'.$request->get('query').'%')
                ->limit(10)
                ->get();
        }
        return new JsonResponse($result);
    }
}
