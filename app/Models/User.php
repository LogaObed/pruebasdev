<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // funcion relacion con post
    public function post(){
        // relacion de uno a muchos hasMany(Modelo)
        return $this->hasMany(Post::class);
    }
    public function comentario(){
        return $this->hasMany(Comentario::class);
    }
    public function Likes(){
        return $this->hasMany(Like::class);
    }
    public function followers(){
        // relacion de muchos a muchos(Modelo,tabla_pibote_con_dos_id_de_una_Tabla,CampoId,Campoid)
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    //siguiendo
    public function follogins(){
        // relacion de muchos a muchos(Modelo,tabla_pibote_con_dos_id_de_una_Tabla,CampoId,Campoid)
        // busca en la tabla followers, por el campo follower_id relacionados por user
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }
    //funcion de seguidores
    public function seguidor(User $user){
        return $this->followers->contains($user->id);
    }
}
