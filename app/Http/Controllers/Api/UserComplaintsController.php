<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;

class UserComplaintsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {

        $search = $request->get('search', '');

        $complaints = $user
            ->complaints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $validated = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $complaint = $user->complaints()->create($validated);

        return new ComplaintResource($complaint);
    }
}
