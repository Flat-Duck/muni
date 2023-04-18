<?php

namespace App\Http\Controllers\Api\Dashboard;

use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintTypeResource;
use App\Http\Resources\ComplaintTypeCollection;
use App\Http\Requests\ComplaintTypeStoreRequest;
use App\Http\Requests\ComplaintTypeUpdateRequest;

class ComplaintTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ComplaintType::class);

        $search = $request->get('search', '');

        $complaintTypes = ComplaintType::search($search)
            ->latest()
            ->paginate();

        return new ComplaintTypeCollection($complaintTypes);
    }

    /**
     * @param \App\Http\Requests\ComplaintTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintTypeStoreRequest $request)
    {
        $this->authorize('create', ComplaintType::class);

        $validated = $request->validated();

        $complaintType = ComplaintType::create($validated);

        return new ComplaintTypeResource($complaintType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ComplaintType $complaintType)
    {
        $this->authorize('view', $complaintType);

        return new ComplaintTypeResource($complaintType);
    }

    /**
     * @param \App\Http\Requests\ComplaintTypeUpdateRequest $request
     * @param \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(
        ComplaintTypeUpdateRequest $request,
        ComplaintType $complaintType
    ) {
        $this->authorize('update', $complaintType);

        $validated = $request->validated();

        $complaintType->update($validated);

        return new ComplaintTypeResource($complaintType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ComplaintType $complaintType)
    {
        $this->authorize('delete', $complaintType);

        $complaintType->delete();

        return response()->noContent();
    }
}
