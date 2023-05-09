<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Notification;

class OrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        if( $request->user()->isSuperAdmin()){
            $orders = Order::search($search)
            ->latest()
            ->paginate();
        }else{
            $municipality = $request->user()->municipality;

            $orders = $municipality
                ->orders()
                ->search($search)
                ->latest()
                ->paginate();
        }
        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {

        return new OrderResource($order);
    }

    /**
     * @param \App\Http\Requests\OrderUpdateRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {

        $validated = $request->validated();

        $order->update($validated);

        if($order->status == "رفض"){
            $notification = new Notification();
            $notification->title = "رفض طلب";
            $notification->description = $request->description;
            $notification->user_id = $order->user_id;
            $notification->save();
        }
        if($order->status == "قبول"){
            $notification = new Notification();
            $notification->title = "قبول طلب";
            $notification->description = "تم قبول طلبكم";
            $notification->user_id = $order->user_id;
            $notification->save();
        }

        return new OrderResource($order);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfuly',
        ]);
    }
}
