<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplaintPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the complaint can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list complaints');
    }

    /**
     * Determine whether the complaint can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function view(User $user, Complaint $model)
    {
        return $user->hasPermissionTo('view complaints');
    }

    /**
     * Determine whether the complaint can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create complaints');
    }

    /**
     * Determine whether the complaint can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function update(User $user, Complaint $model)
    {
        return $user->hasPermissionTo('update complaints');
    }

    /**
     * Determine whether the complaint can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function delete(User $user, Complaint $model)
    {
        return $user->hasPermissionTo('delete complaints');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete complaints');
    }

    /**
     * Determine whether the complaint can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function restore(User $user, Complaint $model)
    {
        return false;
    }

    /**
     * Determine whether the complaint can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Complaint  $model
     * @return mixed
     */
    public function forceDelete(User $user, Complaint $model)
    {
        return false;
    }
}
