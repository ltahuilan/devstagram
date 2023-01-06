<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    public function index(User $user)
    {
        //consultar los posts asociados con el user_id
        $posts = Post::where('user_id', $user->id)->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() {

        return view('posts.create');
    }


    public function store(Request $request) {

        $request->validate([
            'titulo' => ['required', 'min:5', 'max:255'],
            'descripcion' => ['required', 'min:5', 'max:600'],
            'imagen' => ['required']
        ]);

        // Post::create([
            // 'titulo' => $request->titulo,
            // 'descripcion' => $request->descripcion,
            // 'imagen' => $request->imagen,
            // 'user_id' => auth()->user()->id
        // ]);

        /**Otra forma de crear registros */
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        /**Otra forma de crear un registro utilizando las relationships... */

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //redireccionar hacia el muro
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post) {

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post, User $user) {
        
        //verifica si el policy se cumple
        $this->authorize('delete', $post);

        //eliminar la publicación
        $post->delete();

        //eliminar la imagen del servidor
        $imagen_path = public_path('uploads/') . $post->imagen;
        
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
