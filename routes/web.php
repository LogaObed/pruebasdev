<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');
// crearcuenta
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);
// login
Route::get('/iniciar', [LoginController::class, 'index'])->name('login');
Route::post('/iniciar', [LoginController::class, 'store']);
//editar permil
Route::get('/editar-perfil/{user:username}',[PerfilController::class,'edit'])->name('perfil.edit');
Route::put('/editar-perfil/{user:username}',[PerfilController::class,'update'])->name('perfil.update');
// cerrar cesion 
Route::post('/cerrar-sesion', [LogoutController::class, 'store'])->name('logout');
        // post con url dinamico {modelo:el atributo}
Route::get('/publicacion/crear', [PostController::class, 'create'])->name('post.crear');
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::post('/publicacion',[PostController::class,'store'])->name('post.store');
// Route::get('/publicacion/{nombre_del_modelo}',[PostController::class,'show'])->name('post.show');
Route::get('/{user:username}/publicacion/{post}',[PostController::class,'show'])->name('post.show');
Route::delete('/publicacion/{post}',[PostController::class,'destroy'])->name('post.destroy');
// comentarios
Route::post('/{user:username}/publicacion/{post}',[ComentarioController::class,'store'])->name('comentario.store');
Route::delete('/comentario/{comentario}',[ComentarioController::class,'destroy'])->name('comentario.destroy');
// imagenes 
Route::post('/imagenes',[ImagenController::class,'store'])->name('imagen.store');
// linkes 
Route::post('/publicacion/{post}/likes',[LikeController::class,'store'])->name('like.store');
Route::delete('/publicaicon/{post}/likes',[LikeController::class,'destroy'])->name('like.destroy');
// seguifores
Route::post('/{user:username}/follower',[FollowerController::class,'store'])->name('follower.store');
Route::delete('/{user:username}/follower',[FollowerController::class,'destroy'])->name('follower.destroy');

