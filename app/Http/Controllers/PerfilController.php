<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function edit(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }
        return view('perfil.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        // dd($request);
        $this->validate($request, [
            // valida que un name sea tuyo                                        no recibe ciertos campos
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:25', 'not_in:editar-perfil,crear-cuenta'],
            'imagen' => 'image'
        ]);
        if ($request->imagen) {
            if (auth()->user()->imagen != null) {
                $ruta = public_path("perfiles/" . auth()->user()->imagen);
                if (File::exists($ruta)) {
                    // dd($ruta);
                    unlink($ruta);
                }
            }
            $imagen = $request->file('imagen');
            // Crear mombre unico a la imagem 
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            // creacion una modificacion a una imagen
            $imagenRecorte = Image::make($imagen);
            $imagenRecorte->fit(1000, 1000);
            // mover imagen 
            $imagenPath = public_path("perfiles/$nombreImagen");
            $imagenRecorte->save($imagenPath);
        }
        // guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();
        return redirect()->route('post.index', $usuario->username);
    }
}
