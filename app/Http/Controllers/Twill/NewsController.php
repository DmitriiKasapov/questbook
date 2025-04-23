<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Fieldsets;
use A17\Twill\Services\Forms\Fields\{
    BlockEditor,
    // DatePicker,
    Input,
    Medias,
    Select,
};
use A17\Twill\Services\Forms\Form;
use App\Models\News;
use App\Repositories\NewsCategoryRepository;
use App\Traits\WithMeta;

class NewsController extends BaseModuleController
{
    use WithMeta;

    protected $moduleName = 'news';

    protected $indexColumns = [
        'feature' => [
            'title' => 'Izpostavljeno',
            'field' => 'featured',
        ],
        'title' => [
            'title' => 'Naslov',
            'field' => 'title',
            'sort' => true,
        ],
        'category' => [
            'title' => 'Kategorija',
            'relationship' => 'category',
            'field' => 'title',
            'sort' => true,
        ],
    ];

    protected function setUpController(): void
    {
        $this->disableEditor();
        $this->enableDuplicate();
        $this->enableFeature();
    }

    protected function formData($request)
    {
        $news = News::find($request->news);

        return [
            'localizedCustomPermalink' => [
                'sl' => route('news.show', ['locale' => 'sl', $news]),
                'en' => route('news.show', ['locale' => 'en', $news->slugs->where('locale', 'en')->where('active', 1)->first()->slug ?? $news]),
            ],
        ];
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

        $form->withFieldSets(new Fieldsets([
            Fieldset::make()->title('Splošno')->id('general')->closed()->fields([
                // DatePicker::make()
                //     ->name('start_time')
                //     ->label('Čas objave')
                //     ->altFormat('H:i')
                //     ->minuteIncrement(15)
                //     ->time24h()
                //     ->timeOnly(),
                Select::make()
                    ->name('category_id')
                    ->label('Kategorija')
                    ->placeholder('Izberite kategorijo')
                    ->searchable()
                    ->options(
                        app()->make(NewsCategoryRepository::class)->listAll()->toArray()
                    ),
                Medias::make()
                    ->name('cover')
                    ->label('Naslovna slika'),
                Input::make()
                    ->translatable()
                    ->name('description')
                    ->label('Opis')
                    ->placeholder('Vnesite opis')
                    ->type('textarea')
                    ->rows(2),
            ]),
            Fieldset::make()->title('Vsebina')->id('content')->closed()->fields([
                BlockEditor::make()
                    ->blocks([
                        'buttons',
                        'faq',
                        'gallery',
                        'image',
                        'links',
                        'text',
                        'video',
                    ]),
            ]),
        ]));

        return $form;
    }
}
