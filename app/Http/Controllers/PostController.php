<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //autendicacion de inicio de sesion
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    // datos del usuariopor medio de su controlado, se envian a los muros
    public function index(User $user)
    {
        // filtar las publicaicones
        // $post = Post::where('user_id', $user->id)->get();
        // filtar las publicaicones con paginacion
        $post = Post::where('user_id', $user->id)->latest()->paginate(20);
        return view('dashboard', compact('user', 'post'));
    }
    public function create()
    {
        dd("dato");
        // return view('post.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'titulo' => 'required|max:250',
            'descripcion' => 'required|max:500',
            'imagen' => 'required'
        ]);
        // se debe agregar en el modleo los campos que se van a recibir
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        /* 
        se debe agregar en el modleo los campos que se van a recibir
        $datos_post->modelo_relacionado()->relacion()->accion([datos]);
        $request->user()->post()->create([
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,   
        'user_id'=>auth()->user()->id  
       ]);
        */

        return redirect()->route('post.index', auth()->user()->username);
    }
    // importar dos modelos para la vista 
    public function show(User $user, Post $post)
    {
        // dd($post);
        return view('post.show', compact('post', 'user'));
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $ruta = public_path("uploads/$post->imagen");
        if (File::exists($ruta)) {
            unlink($ruta);
        }
        $post->delete();
        return redirect()->route('post.index', auth()->user()->username);
    }
}
