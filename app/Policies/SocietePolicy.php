<?php

namespace App\Policies;

use App\Models\Societe;
use App\Models\User;

class SocietePolicy
{
    public function manage(User $user, Societe $societe = null): bool
    {
        return $user->hasPermissionTo('manage societe');
    }
}
