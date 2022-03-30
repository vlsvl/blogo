<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Filters\CommentFilter;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UploadController extends Controller
{


    /**
     * Upload file from quill editor
     *
     * @param  Request $request
     * @param  Post    $post
     * @return JsonResponse
     * @throws ValidationException
     */
    public function uploadImage(Request $request, Post $post): JsonResponse
    {
        $this->validate(
            $request,
            ['file' => 'required|mimes:png,jpeg,jpg']
        );

        $originName = $request->file('file')->getClientOriginalName();
        $fileName   = pathinfo($originName, PATHINFO_FILENAME);
        $extension  = $request->file('file')->getClientOriginalExtension();
        $filename   = $fileName.'_'.time().'.'.$extension;

        $imgSavedPath = 'images/posts/'.$post->slug;

        $request->file('file')->storeAs('public/'.$imgSavedPath, $filename);
        $url = Storage::url("$imgSavedPath/$filename");

        return new JsonResponse(
            ['link' => $url]
        );

    }//end uploadImage()


}//end class
