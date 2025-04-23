<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $query, Model $model): void
    {
        if (!routeName('twill') || request()->isPreview/* && !is_null(routeName())*/) {
            $query->where('published', 1)->whereTranslation('active', 1, locale());
        }
    }
}
