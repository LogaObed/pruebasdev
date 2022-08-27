<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // dd($request->get('username'));
        // sobre escribir un valor de request para validar la url creada con el user name
        $request->request->add(['username'=>Str::slug($request->username)]);
        // validaciones
        $this->validate($request,[
            'name'=>'required|min:3|max:25',
            // validacion de campo unico en su tabla
            'username'=>'required|min:3|max:25|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
            
        ]);
        // dd($request);

        //importar el modelo
        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        //autenticas una sesion
        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password'=>$request->password

        // ]);
        auth()->attempt($request->only('email','password'));
        return redirect()->route('post.index',auth()->user());
    }
}
