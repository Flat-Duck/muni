<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', News::class);

        $search = $request->get('search', '');

        $allNews = News::search($search)
            ->latest()
            ->paginate();

        return new NewsCollection($allNews);
    }

    /**
     * @param \App\Http\Requests\NewsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        $this->authorize('create', News::class);

        $validated = $request->validated();

        $news = News::create($validated);

        return new NewsResource($news);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, News $news)
    {
        $this->authorize('view', $news);

        return new NewsResource($news);
    }

    /**
     * @param \App\Http\Requests\NewsUpdateRequest $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $this->authorize('update', $news);

        $validated = $request->validated();

        $news->update($validated);

        return new NewsResource($news);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return response()->noContent();
    }
}
