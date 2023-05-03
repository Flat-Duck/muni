<?php

namespace App\Http\Controllers\Api\Application;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipalityCollection;

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
        ->OnlyActive()
            ->latest()
            ->paginate();

        return new MunicipalityCollection($municipalities);
    }
}
