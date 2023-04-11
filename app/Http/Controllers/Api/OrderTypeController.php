<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderTypeResource;
use App\Http\Resources\OrderTypeCollection;
use App\Http\Requests\OrderTypeStoreRequest;
use App\Http\Requests\OrderTypeUpdateRequest;

class OrderTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', OrderType::class);

        $search = $request->get('search', '');

        $orderTypes = OrderType::search($search)
            ->latest()
            ->paginate();

        return new OrderTypeCollection($orderTypes);
    }

    /**
     * @param \App\Http\Requests\OrderTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderTypeStoreRequest $request)
    {
        $this->authorize('create', OrderType::class);

        $validated = $request->validated();

        $orderType = OrderType::create($validated);

        return new OrderTypeResource($orderType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderType $orderType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OrderType $orderType)
    {
        $this->authorize('view', $orderType);

        return new OrderTypeResource($orderType);
    }

    /**
     * @param \App\Http\Requests\OrderTypeUpdateRequest $request
     * @param \App\Models\OrderType $orderType
     * @return \Illuminate\Http\Response
     */
    public function update(
        OrderTypeUpdateRequest $request,
        OrderType $orderType
    ) {
        $this->authorize('update', $orderType);

        $validated = $request->validated();

        $orderType->update($validated);

        return new OrderTypeResource($orderType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderType $orderType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrderType $orderType)
    {
        $this->authorize('delete', $orderType);

        $orderType->delete();

        return response()->noContent();
    }
}
