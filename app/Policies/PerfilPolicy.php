<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $perfil)
    {
        return $user === $perfil;
    }
}
