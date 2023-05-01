<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class UserOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {

        $search = $request->get('search', '');

        $orders = $user
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:إنتظار,قبول,رفض'],
            'active' => ['required', 'boolean'],
            'order_type_id' => ['required', 'exists:order_types,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $order = $user->orders()->create($validated);

        return new OrderResource($order);
    }
}
