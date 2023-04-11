<?php

namespace App\Http\Controllers\Api;

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
        $this->authorize('view-any', Municipality::class);

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
        $this->authorize('create', Municipality::class);

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
        $this->authorize('view', $municipality);

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
        $this->authorize('update', $municipality);

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
        $this->authorize('delete', $municipality);

        $municipality->delete();

        return response()->noContent();
    }
}
