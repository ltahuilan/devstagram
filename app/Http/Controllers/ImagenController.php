<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request) {
        
        $imagen = $request->file('file');

        //generar nombre para la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //procesar imagen con intervention image
        $imagenServidor = Image::make($imagen);

        //redimensionar la imagen
        $imagenServidor->fit(1000, 1000);
        
        //ruta para almacenar la imagen
        $imagenPath = public_path('uploads') . "/" . $nombreImagen;

        //guardar la imagen
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
