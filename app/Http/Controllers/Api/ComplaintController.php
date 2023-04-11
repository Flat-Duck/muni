<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;
use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;

class ComplaintController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Complaint::class);

        $search = $request->get('search', '');

        $complaints = Complaint::search($search)
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
        $this->authorize('create', Complaint::class);

        $validated = $request->validated();

        $complaint = Complaint::create($validated);

        return new ComplaintResource($complaint);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Complaint $complaint)
    {
        $this->authorize('view', $complaint);

        return new ComplaintResource($complaint);
    }

    /**
     * @param \App\Http\Requests\ComplaintUpdateRequest $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(
        ComplaintUpdateRequest $request,
        Complaint $complaint
    ) {
        $this->authorize('update', $complaint);

        $validated = $request->validated();

        $complaint->update($validated);

        return new ComplaintResource($complaint);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Complaint $complaint)
    {
        $this->authorize('delete', $complaint);

        $complaint->delete();

        return response()->noContent();
    }
}
