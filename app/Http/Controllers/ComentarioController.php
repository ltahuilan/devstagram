<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        //validacion
        $this->validate($request , [
            'comentario' => ['required', 'max:255', 'min:5']
        ]);

        //guardar en la BD
        Comentario::create([
            'user_id' => auth()->user()->id, //id del usuario que comentó la publicacion
            'post_id' => $post->id, //id del post
            'comentario' => $request->comentario
        ]);

        //mostrar alerta
        return back()->with('mensaje', 'Comentario agregado correctamente');
    }

    
}
