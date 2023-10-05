<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        
        $imagen = $request->file('file');

        //generar nombre aleatorio y extension de archivo
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        //genear archivo para subir al servidor
        $imagenServidor = Image::make($imagen);

        //redimensionar la imagen
        $imagenServidor->fit(1000, 1000);

        //crear el path para almacenar la imagen
        $imagenPath = public_path('uploads/') . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}
