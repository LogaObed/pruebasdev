<?php

namespace App\Policies;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComentarioPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comentario $comentario)
    {
        return $user->id === $comentario->user_id;
    }

 
   
}
