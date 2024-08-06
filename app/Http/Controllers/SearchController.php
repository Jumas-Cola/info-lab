<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(protected PageRepository $pageRepository)
    {
        parent::__construct();
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $results = $this->pageRepository
            ->notHidden()
            ->where('title', 'ilike', "%{$query}%")
            ->limit(10)
            ->get()->map(function ($page) {
                return [
                    'title' => $page->title,
                    'url' => url("pages/{$page->getNestedSlug()}"),
                ];
            });

        return response()->json($results);
    }
}
