<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\News;
// use App\Traits\WithCustomTimes;

class NewsRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations, HandleSlugs, HandleMedias, HandleRevisions/*, WithCustomTimes*/;

    public bool $fieldsGroupsFormFieldNamesAutoPrefix = true;
    public string $fieldsGroupsFormFieldNameSeparator = '.';

    protected array $fieldsGroups = [
        'meta' => [
            'title',
            'description',
            'keywords',
        ],
    ];

    public function __construct(News $model)
    {
        $this->model = $model;
    }
}
