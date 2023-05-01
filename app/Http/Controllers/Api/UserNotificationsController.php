<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\NotificationCollection;

class UserNotificationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {

        $search = $request->get('search', '');

        $notifications = $user
            ->notifications()
            ->search($search)
            ->latest()
            ->paginate();

        return new NotificationCollection($notifications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'seen' => ['required', 'boolean'],
        ]);

        $notification = $user->notifications()->create($validated);

        return new NotificationResource($notification);
    }
}
