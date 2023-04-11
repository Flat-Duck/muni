<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\NotificationCollection;
use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;

class NotificationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Notification::class);

        $search = $request->get('search', '');

        $notifications = Notification::search($search)
            ->latest()
            ->paginate();

        return new NotificationCollection($notifications);
    }

    /**
     * @param \App\Http\Requests\NotificationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationStoreRequest $request)
    {
        $this->authorize('create', Notification::class);

        $validated = $request->validated();

        $notification = Notification::create($validated);

        return new NotificationResource($notification);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Notification $notification)
    {
        $this->authorize('view', $notification);

        return new NotificationResource($notification);
    }

    /**
     * @param \App\Http\Requests\NotificationUpdateRequest $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(
        NotificationUpdateRequest $request,
        Notification $notification
    ) {
        $this->authorize('update', $notification);

        $validated = $request->validated();

        $notification->update($validated);

        return new NotificationResource($notification);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Notification $notification)
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return response()->noContent();
    }
}
