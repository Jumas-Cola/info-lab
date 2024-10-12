<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Tag;
use App\Repositories\PageRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageDisplayController extends Controller
{
    public function index(Request $request, PageRepository $pageRepository)
    {
        $selectedTags = $request->get('tags') ?? [];

        $pages = $pageRepository->notHidden()
            ->whereNull('parent_id')
            ->published()
            ->with('tags');

        if (! empty($selectedTags) and is_array($selectedTags)) {
            $pages = $pages->whereHas('tags', function ($query) use ($selectedTags) {
                $query->whereIn('name', $selectedTags);
            });
        }

        $pages = $pages->orderBy('position')
            ->paginate();

        $tagsCloud = Tag::orderBy('count', 'desc')->limit(30)->get(['id', 'name']);

        return view('site.page.index', [
            'pages' => $pages,
            'tagsCloud' => $tagsCloud,
        ]);
    }

    public function show(string $slug, PageRepository $pageRepository): View
    {
        try {
            $page = $pageRepository->forNestedSlug($slug);
        } catch (\Throwable $th) {
            abort(404);
        }

        if (! $page) {
            abort(404);
        }

        return view('site.page.show', ['page' => $page]);
    }
}
