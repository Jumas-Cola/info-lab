<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleTags;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;

class PageRepository extends ModuleRepository
{
    use HandleBlocks, HandleFiles, HandleMedias, HandleNesting, HandleSlugs, HandleTags;

    public function notHidden(): Builder
    {
        return $this->model->where('hidden', false);
    }

    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}
