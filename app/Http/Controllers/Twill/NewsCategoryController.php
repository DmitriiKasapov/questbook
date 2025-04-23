<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class NewsCategoryController extends BaseModuleController
{
    protected $moduleName = 'newsCategories';

    protected $indexColumns = [
        'title' => [
            'title' => 'Naslov',
            'field' => 'title',
        ],
    ];

    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->enableDuplicate();
        $this->enableEditInModal();
        $this->enableReorder();
    }

    public function getCreateForm(): Form
    {
        $form = Form::make();

        $form->add(
            Input::make()
                ->translatable()
                ->name('title')
                ->label('Naslov')
                ->placeholder('Vnesite naslov'),
        );

        return $form;
    }

    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()
                ->translatable()
                ->name('title')
                ->label('Naslov')
                ->placeholder('Vnesite naslov'),
        );

        return $form;
    }
}
