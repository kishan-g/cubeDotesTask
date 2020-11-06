<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        foreach ($user->roles as $role) {

            if (in_array($role->id, [1]) and $role->status == 'Active') {

                return true;
            }
        }

        return false;
    }
    public function edit(User $user)
    {
        foreach ($user->roles as $role) {

            if (in_array($role->id, [1, 2]) and $role->status == 'Active') {

                return true;
            }
        }

        return false;
    }
    public function delete(User $user)
    {
        foreach ($user->roles as $role) {

            if (in_array($role->id, [1]) and $role->status == 'Active') {

                return true;
            }
        }

        return false;
    }
}
