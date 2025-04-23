<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use App\Models\Scopes\OrderScope;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy([OrderScope::class, PublishedScope::class])]
class NewsCategory extends Model implements Sortable
{
    use HasTranslation, HasSlug, HasRevisions, HasPosition;

    protected $fillable = [
        'published',
        'position',
        'title',
    ];

    public $translatedAttributes = [
        'title',
    ];

    public $slugAttributes = [
        'title',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * Relationships
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
