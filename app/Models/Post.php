<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // relaciar una relacion inversa, solo por la relacion creada en usuario
    public function user()
    {
        // filtar solo los datos necesarios 
        return $this->belongsTo(User::class)->select(['name','username']);
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    // validar si exite un registro en la tabla pibote likes
    // relaciona el post con el user y valida
    public function checkLikes(User $user){
             //modeloactual->modleoRelacionado->calidacion->xontien(campo,dato) 
             return $this->likes->contains('user_id',$user->id);
    }
}
