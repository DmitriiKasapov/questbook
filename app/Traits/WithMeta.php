<?php

namespace App\Traits;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\BladePartial;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Form;

trait WithMeta
{
    public function getSideFieldsets(TwillModelContract $model): Form
    {
        $form = parent::getSideFieldsets($model);

        $form->addFieldset(
            Fieldset::make()->title('Meta')->id('meta')->closed()->fields([
                BladePartial::make()->view('components.twill.meta')
            ])
        );

        return $form;
    }
}
