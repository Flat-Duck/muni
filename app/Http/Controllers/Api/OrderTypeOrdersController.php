<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class OrderTypeOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderType $orderType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderType $orderType)
    {
        $this->authorize('view', $orderType);

        $search = $request->get('search', '');

        $orders = $orderType
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderType $orderType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrderType $orderType)
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:'],
            'active' => ['required', 'boolean'],
            'user_id' => ['required', 'exists:users,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $order = $orderType->orders()->create($validated);

        return new OrderResource($order);
    }
}
