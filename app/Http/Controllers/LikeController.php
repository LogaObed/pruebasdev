<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request,Post $post){
    //    $post->likes()->create(['user_id'=>$request->user()->id]);
    //    return back();
    }
    public function destroy(Request $request, Post $post){
        // usuario_autenticado->modelo_asociado->busqueda(id_metodo2,valor)->elimianr
        // $request->user()->likes()->where('post_id',$post->id)->delete();
        // return back();
    }
}
