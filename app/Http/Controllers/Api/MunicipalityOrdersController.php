<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class MunicipalityOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Municipality $municipality)
    {

        $search = $request->get('search', '');

        $orders = $municipality
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Municipality $municipality)
    {

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:إنتظار,قبول,رفض'],
            'active' => ['required', 'boolean'],
            'order_type_id' => ['required', 'exists:order_types,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $order = $municipality->orders()->create($validated);

        return new OrderResource($order);
    }
}

