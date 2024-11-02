<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ClassroomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $ability = ['Admin', 'guest'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }
    public function deleted(User $user, Classroom $classroom): bool
    {
        $ability = ['Admin'];
        $match = array_intersect($ability, $user->role);
        if ($match) {
            return true;
        } else {
            return false;
        }
    }
}
