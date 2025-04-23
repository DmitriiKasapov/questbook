<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\News;

class NewsTranslation extends Model
{
    protected $baseModuleModel = News::class;

    public $casts = [
        'meta' => 'array',
    ];
}
