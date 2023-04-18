<?php

namespace App\Http\Controllers\Api\Application;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\NotificationCollection;

class NotificationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

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
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Notification $notification)
    {
        return new NotificationResource($notification);
    }
}
