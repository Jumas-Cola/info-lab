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
            ->where('title', 'like', "%{$query}%")
            ->with('parent')
            ->limit(10)
            ->get()->map(function ($page) {
                $parentTitle = $page->parent ? $page->parent->title : '';
                $title = $page->title;
                if ($parentTitle) {
                    $title = "{$parentTitle} - {$title}";
                }

                return [
                    'title' => $title,
                    'url' => url("pages/{$page->getNestedSlug()}"),
                ];
            });

        return response()->json($results);
    }
}
