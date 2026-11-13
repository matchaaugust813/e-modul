<?php

namespace App\Policies;

use App\Models\Modul;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === 'guru' || $user->isSuperAdmin();
    }

    public function view(User $user, Modul $modul): bool
    {
        return $user->role === 'guru' || $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return $user->role === 'guru';
    }

    public function update(User $user, Modul $modul): bool
    {
        return $user->role === 'guru' && $user->id === $modul->guru_id;
    }

    public function delete(User $user, Modul $modul): bool
    {
        return ($user->role === 'guru' && $user->id === $modul->guru_id) || $user->isSuperAdmin();
    }
}
