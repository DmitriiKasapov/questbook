<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\NewsCategory;

class NewsCategoryTranslation extends Model
{
    protected $baseModuleModel = NewsCategory::class;
}
