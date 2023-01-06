<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post) {
        // User $user no se utiliza en este metodo pero es requerido porque la ruta espera ese parámetro

        //validacion
        $request->validate([
            'comentario' => ['required', 'max:255']
        ]);

        //Guardar el comentario en la BD
        // Comentario::create([
        //     'user_id' => auth()->user()->id,
        //     'post_id' => $post->id,
        //     'comentario' => $request->comentario
        // ]);

        $post->comentarios()->create([
            'user_id' => auth()->user()->id,
            // 'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //redireccionar a la página anterior y mostrar mensaje
        return back()->with('mensaje', 'Comentario agregado correctamente');
        
    }
}
