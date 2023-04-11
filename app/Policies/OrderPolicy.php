<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the order can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the order can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function view(User $user, Order $model)
    {
        return true;
    }

    /**
     * Determine whether the order can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the order can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function update(User $user, Order $model)
    {
        return true;
    }

    /**
     * Determine whether the order can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function delete(User $user, Order $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the order can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function restore(User $user, Order $model)
    {
        return false;
    }

    /**
     * Determine whether the order can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Order  $model
     * @return mixed
     */
    public function forceDelete(User $user, Order $model)
    {
        return false;
    }
}
