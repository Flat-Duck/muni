<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Municipality;
use Illuminate\Auth\Access\HandlesAuthorization;

class MunicipalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the municipality can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list municipalities');
    }

    /**
     * Determine whether the municipality can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function view(User $user, Municipality $model)
    {
        return $user->hasPermissionTo('view municipalities');
    }

    /**
     * Determine whether the municipality can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create municipalities');
    }

    /**
     * Determine whether the municipality can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function update(User $user, Municipality $model)
    {
        return $user->hasPermissionTo('update municipalities');
    }

    /**
     * Determine whether the municipality can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function delete(User $user, Municipality $model)
    {
        return $user->hasPermissionTo('delete municipalities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete municipalities');
    }

    /**
     * Determine whether the municipality can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function restore(User $user, Municipality $model)
    {
        return false;
    }

    /**
     * Determine whether the municipality can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Municipality  $model
     * @return mixed
     */
    public function forceDelete(User $user, Municipality $model)
    {
        return false;
    }
}
