<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;

class MunicipalityComplaintsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Municipality $municipality)
    {

        $search = $request->get('search', '');

        $complaints = $municipality
            ->complaints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Municipality $municipality)
    {

        $validated = $request->validate([
            'content' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $complaint = $municipality->complaints()->create($validated);

        return new ComplaintResource($complaint);
    }
}
