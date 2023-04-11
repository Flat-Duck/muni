<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the news can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allnews');
    }

    /**
     * Determine whether the news can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function view(User $user, News $model)
    {
        return $user->hasPermissionTo('view allnews');
    }

    /**
     * Determine whether the news can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allnews');
    }

    /**
     * Determine whether the news can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function update(User $user, News $model)
    {
        return $user->hasPermissionTo('update allnews');
    }

    /**
     * Determine whether the news can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function delete(User $user, News $model)
    {
        return $user->hasPermissionTo('delete allnews');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allnews');
    }

    /**
     * Determine whether the news can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function restore(User $user, News $model)
    {
        return false;
    }

    /**
     * Determine whether the news can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\News  $model
     * @return mixed
     */
    public function forceDelete(User $user, News $model)
    {
        return false;
    }
}
