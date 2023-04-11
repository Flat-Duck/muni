<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the notification can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list notifications');
    }

    /**
     * Determine whether the notification can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function view(User $user, Notification $model)
    {
        return $user->hasPermissionTo('view notifications');
    }

    /**
     * Determine whether the notification can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create notifications');
    }

    /**
     * Determine whether the notification can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function update(User $user, Notification $model)
    {
        return $user->hasPermissionTo('update notifications');
    }

    /**
     * Determine whether the notification can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function delete(User $user, Notification $model)
    {
        return $user->hasPermissionTo('delete notifications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete notifications');
    }

    /**
     * Determine whether the notification can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function restore(User $user, Notification $model)
    {
        return false;
    }

    /**
     * Determine whether the notification can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Notification  $model
     * @return mixed
     */
    public function forceDelete(User $user, Notification $model)
    {
        return false;
    }
}
