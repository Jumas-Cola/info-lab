<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class HomeController extends Controller
{
    public function __construct(protected PageRepository $pageRepository)
    {
        parent::__construct();
    }

    public function __invoke(): mixed
    {
        $labPage = $this->pageRepository->forSlug('laboratornye');

        $latestLabs = $this->pageRepository->notHidden()
            ->where('parent_id', $labPage->id)
            ->published()
            ->orderBy('position', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('latestLabs'));
    }
}
