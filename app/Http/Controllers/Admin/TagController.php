<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function load(Request $request)
    {
        $this->validate($request, [
            'tag' => 'string|required'
        ]);

        $tags = Tag::where('name', 'like', "%{$request->get('tag')}%")
            ->select(['id', 'name'])
            ->get();

        return new JsonResponse(['tags' => $tags]);
    }
}
