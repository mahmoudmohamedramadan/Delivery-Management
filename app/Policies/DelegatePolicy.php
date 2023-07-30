<?php

namespace App\Policies;

use App\User;
use App\Models\Delegate;
use Illuminate\Auth\Access\HandlesAuthorization;

class DelegatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\Modsels\Delegate $delegate
     * @return mixed
     */
    public function view(User $user, Delegate $delegate)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->email === 'mahmoudramadan496@gmail.com';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Modsels\Delegate $delegate
     * @return mixed
     */
    public function update(User $user, Delegate $delegate)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\Modsels\Delegate $delegate
     * @return mixed
     */
    public function delete(User $user, Delegate $delegate)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param \App\Modsels\Delegate $delegate
     * @return mixed
     */
    public function restore(User $user, Delegate $delegate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param \App\Modsels\Delegate $delegate
     * @return mixed
     */
    public function forceDelete(User $user, Delegate $delegate)
    {
        //
    }
}
