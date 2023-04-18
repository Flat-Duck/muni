<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;

class ComplaintTypeComplaintsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ComplaintType $complaintType)
    {
        $this->authorize('view', $complaintType);

        $search = $request->get('search', '');

        $complaints = $complaintType
            ->complaints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ComplaintType $complaintType)
    {
        $this->authorize('create', Complaint::class);

        $validated = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $complaint = $complaintType->complaints()->create($validated);

        return new ComplaintResource($complaint);
    }
}
