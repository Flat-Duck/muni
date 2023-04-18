<?php

namespace App\Http\Controllers\Api\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;

class NewsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $search = $request->get('search', '');

        $municipality = $user->municipality;

        $allNews = $municipality
            ->allNews()
            ->search($search)
            ->latest()
            ->paginate();

        return new NewsCollection($allNews);
    }
}
