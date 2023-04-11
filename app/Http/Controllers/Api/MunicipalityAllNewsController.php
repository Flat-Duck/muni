<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;

class MunicipalityAllNewsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Municipality $municipality)
    {
        $this->authorize('view', $municipality);

        $search = $request->get('search', '');

        $allNews = $municipality
            ->allNews()
            ->search($search)
            ->latest()
            ->paginate();

        return new NewsCollection($allNews);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Municipality $municipality)
    {
        $this->authorize('create', News::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
        ]);

        $news = $municipality->allNews()->create($validated);

        return new NewsResource($news);
    }
}
