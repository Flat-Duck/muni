<?php

namespace App\Http\Controllers\Api\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;

class ComplaintController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->get('search', '');

        $complaints = $user
            ->complaints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \App\Http\Requests\ComplaintStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintStoreRequest $request)
    {
        $user = $request->user();

        $validated = $request->validated();

        $validated['municipality_id'] = $user->municipality_id;

        $complaint = $user->complaints()->create($validated);

        if (request()->has(['image'])) {
            $complaint->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return new ComplaintResource($complaint);
    }
}
