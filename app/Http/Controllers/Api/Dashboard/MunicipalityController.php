<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipalityResource;
use App\Http\Resources\MunicipalityCollection;
use App\Http\Requests\MunicipalityStoreRequest;
use App\Http\Requests\MunicipalityUpdateRequest;

class MunicipalityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $municipalities = Municipality::search($search)
            ->latest()
            ->paginate();

        return new MunicipalityCollection($municipalities);
    }

    /**
     * @param \App\Http\Requests\MunicipalityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipalityStoreRequest $request)
    {

        $validated = $request->validated();

        $municipality = Municipality::create($validated);

        return new MunicipalityResource($municipality);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Municipality $municipality)
    {

        return new MunicipalityResource($municipality);
    }

    /**
     * @param \App\Http\Requests\MunicipalityUpdateRequest $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(
        MunicipalityUpdateRequest $request,
        Municipality $municipality
    ) {

        $validated = $request->validated();

        $municipality->update($validated);

        return new MunicipalityResource($municipality);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Municipality $municipality)
    {
        $municipality->delete();

        return response()->noContent();
    }
}
