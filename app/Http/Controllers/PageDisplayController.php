<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use Illuminate\Contracts\View\View;

class PageDisplayController extends Controller
{
    public function index(PageRepository $pageRepository)
    {
        $pages = $pageRepository->notHidden()->whereNull('parent_id')->published()->orderBy('position')->paginate();

        return view('site.page.index', ['pages' => $pages]);
    }

    public function show(string $slug, PageRepository $pageRepository): View
    {
        $page = $pageRepository->forNestedSlug($slug);

        if (! $page) {
            abort(404);
        }

        return view('site.page.show', ['page' => $page]);
    }
}
