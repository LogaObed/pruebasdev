<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        // $usuario_de_sesion->relacion->filtrado->conversion 
        $ids = auth()->user()->follogins->pluck('id')->toArray();
       // Buscqueda en un modelo con un arreglo,orden_ultimo primero y paginas en 20
        $post = Post::whereIn('user_id',$ids)->latest()->paginate(20);
        // dd($post);
        // importar modelo y filtrar
        return view('home',compact('post'));
    }
}
