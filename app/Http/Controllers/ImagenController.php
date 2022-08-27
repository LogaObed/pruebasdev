<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //almacenar imagen
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        // Crear mombre unico a la imagem 
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        // creacion una modificacion a una imagen
        $imagenRecorte = Image::make($imagen);
        $imagenRecorte->fit(1000, 1000);
        // mover imagen 
        $imagenPath = public_path("uploads/$nombreImagen");
        $imagenRecorte->save($imagenPath);
        return response()->json(['imgen' => $nombreImagen]);
    }
}
