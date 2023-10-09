<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        //validar el formulario
        $this->validate($request, [
            'username' => [
                'required',
                Rule::unique('users')->ignore(auth()->user()->id),
                Rule::notIn('facebook', 'tweeter', 'youtube', 'instagram', 'editar-perfil'),
                'alpha_dash:ascii',
                'min:6',
                'max:15'
                ]
        ]);

        //comprobar si hay una imagen seleccionada
        if($request->imagen) {
            $imagen = $request->file('imagen');

            //generar nombre aleatorio y extension de archivo
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            //genear archivo para subir al servidor
            $imagenServidor = Image::make($imagen);

            //redimensionar la imagen
            $imagenServidor->fit(1000,1000);

            //crear el path para almacenar la imagen
            $imagenPath = public_path('profiles/') . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //guardar cambios
        $usuario = User::find( auth()->user()->id );
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username); //se pasa como parametro $usuario->username para que actualice la vista si es modificaodo
    }
}
