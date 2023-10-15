<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function __invoke()
    {
        //obtener los ids de los usuarios a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();

        //obtener los post de los usuarios
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(8);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
