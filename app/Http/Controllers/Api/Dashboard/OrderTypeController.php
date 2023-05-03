<?php

namespace App\Http\Controllers\Api\Dashboard;

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

        $search = $request->get('search', '');

        $orderTypes = OrderType::search($search)
            ->onlyActive()
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

        $orderType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfuly',
        ]);
    }
}
