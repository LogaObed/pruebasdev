<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //validar comentario
    public function store(Request $request,User $user,Post $post)
    {
        
        $this->validate($request, [
            "comentario" => 'required|max:255',
        ]);
        // insertar el comentario 
        Comentario::create([
            'user_id'=>auth()->user()->id,
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
        ]);
        return back()->with('mensaje','Comentario creado');
    }
    public function destroy(Comentario $comentario)
    {
        $this->authorize('delete',$comentario);
        $comentario->delete();
        return back();
    }
}
