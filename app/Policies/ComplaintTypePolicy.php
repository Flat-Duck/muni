<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ComplaintType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplaintTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the complaintType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list complainttypes');
    }

    /**
     * Determine whether the complaintType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function view(User $user, ComplaintType $model)
    {
        return $user->hasPermissionTo('view complainttypes');
    }

    /**
     * Determine whether the complaintType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create complainttypes');
    }

    /**
     * Determine whether the complaintType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function update(User $user, ComplaintType $model)
    {
        return $user->hasPermissionTo('update complainttypes');
    }

    /**
     * Determine whether the complaintType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function delete(User $user, ComplaintType $model)
    {
        return $user->hasPermissionTo('delete complainttypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete complainttypes');
    }

    /**
     * Determine whether the complaintType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function restore(User $user, ComplaintType $model)
    {
        return false;
    }

    /**
     * Determine whether the complaintType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ComplaintType  $model
     * @return mixed
     */
    public function forceDelete(User $user, ComplaintType $model)
    {
        return false;
    }
}
