<?php

namespace App\Http\Controllers\Api\Application;

use App\Models\OrderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderTypeCollection;
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
        ->OnlyActive()
            ->latest()
            ->paginate();

        return new OrderTypeCollection($orderTypes);
    }
}
