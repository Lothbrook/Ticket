<?php

namespace App\Policies;

use App\Models\Stock;
use App\Models\User;

class StockPolicy
{
    public function manage(User $user, Stock $stock = null): bool
    {
        return $user->hasPermissionTo('manage stock');
    }
    public function view(User $user, Stock $stock): bool
    {
        if ($user->hasRole('Admin')) {
            return true;
        }

        return false;
    }
}
