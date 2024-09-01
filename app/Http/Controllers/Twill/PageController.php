<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Tags;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\Checkbox;

class PageController extends BaseModuleController
{
    protected $moduleName = 'pages';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 3;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
        $this->setPermalinkBase('pages');
        $this->withoutLanguageInPermalink();
    }

    protected function form(?int $id, TwillModelContract $item = null): array
    {
        $item = $this->repository->getById($id, $this->formWith, $this->formWithCount);

        if (!empty($item->ancestorsSlug)) {
            $this->permalinkBase .= "/" . $item->ancestorsSlug;
        }

        return parent::form($id, $item);
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Checkbox::make()->name('hidden')->label('Скрыть в блоге')
        );

        $form->add(
            Input::make()->name('description')->label('Описание')
        );

        $form->add(
            Medias::make()->name('cover')->label('Обложка')
        );

        $form->add(
            Tags::make()->name('tags')->label('Теги')
        );

        $form->add(
            BlockEditor::make()
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }
}
