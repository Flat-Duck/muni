<?php

namespace App\Http\Controllers\Api\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $search = $request->get('search', '');

        $orders = $user
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);

    }

    /**
     * @param \App\Http\Requests\OrderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request['municipality_id'] = $user->municipality_id;

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'order_type_id' => ['required', 'exists:order_types,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $order = $user->orders()->create($validated);

        return new OrderResource($order);
    }
}
