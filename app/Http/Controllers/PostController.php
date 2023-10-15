<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //
    public function __construct()
    {
        //verificar si hay usuario autenticado
        $this->middleware('auth')->except('show');
    }

    public function index(User $user)
    {   
        //get() ejecuta la consulta y retorna los datos
        // $posts = $user->posts()->where('user_id', $user->id)->get();

        //paginate() ejecuta la consulta, retorna los datos con paginación
        //latest() ordena los resultdos del más nuevo al más antiguo
        $posts = $user->posts()->where('user_id', $user->id)->latest()->paginate(4);
        
        $followers = Follower::where('user_id', $user->id)->get();
        
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
            'followers' => $followers
        ]);
    }

    /**
     * Create a new post
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a post
     */
    public function store(Request $request)
    {
        //validar campos del formulario
        $this->validate($request, [
            'titulo' => ['required', 'min:6', 'max:255'],
            'descripcion' => ['required'],
            'imagen' => ['required']
        ]);

        //almacenar el post en la base de datos
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);


        //otra forma de guardar los registros en la base de datos
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //guardar registros utilizando Eloquent relationships
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * Show a post
     */
    public function show(User $user,Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    /**
     * Delete a post
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        //eliminar post
        $post->delete();

        //eliminar imagen almacenada
        $imagen_path = public_path('uploads' . '/' . $post->imagen );

        //comprobar si el archivo existe
        if( File::exists( $imagen_path) ) {

            //eliminar el archivo
            File::delete($imagen_path);
        }

        //redirecionar al muro del usuario
        return redirect()->route('posts.index', auth()->user()->username);        
    }
}
