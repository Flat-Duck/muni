<?php

namespace App\Http\Controllers\Api\Application;

use Illuminate\Http\Request;
use App\Models\ComplaintType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintTypeCollection;

class ComplaintTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $complaintTypes = ComplaintType::search($search)
            ->latest()
            ->paginate();
        return new ComplaintTypeCollection($complaintTypes);
    }
}
