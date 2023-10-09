<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        // Like::create([
        //     'post_id' => $post->id,
        //     'user_id' => auth()->user()->id
        // ]);

        //utilizando relationship
        $post->likes()->create([
            'user_id' => $request->user()->id,
            // 'post_id' => $post->id //se obtiene de forma implicita al relacionar el Post con el File
        ]);

        return back();

    }

    public function destroy(Request $request)
    {
        $request->user()->likes()->where('user_id', $request->user()->id)->delete();

        return back();
    }
}
