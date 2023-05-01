<?php

namespace App\Http\Controllers\Api\Dashboard;

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
        $search = $request->get('search', '');

        $municipality = $request->user()->municipality;

        $complaints = $municipality
            ->complaints()
        //    ->with(['user','complaint_type'])
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Complaint $complaint)
    {
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

        $complaint->delete();

        return response()->noContent();
    }
}
