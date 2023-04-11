<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderType;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orderType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orderType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function view(User $user, OrderType $model)
    {
        return true;
    }

    /**
     * Determine whether the orderType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orderType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function update(User $user, OrderType $model)
    {
        return true;
    }

    /**
     * Determine whether the orderType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function delete(User $user, OrderType $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the orderType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function restore(User $user, OrderType $model)
    {
        return false;
    }

    /**
     * Determine whether the orderType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderType  $model
     * @return mixed
     */
    public function forceDelete(User $user, OrderType $model)
    {
        return false;
    }
}
