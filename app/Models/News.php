<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
// use App\Traits\WithCustomPublishedRange;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions/*, WithCustomPublishedRange*/;

    protected $fillable = [
        'published',
        'category_id',
        'featured',
        'publish_start_date',
        'publish_end_date',
        'position',
        'title',
        'description',
        'meta',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'meta',
    ];

    public $slugAttributes = [
        'title',
    ];

    public $mediasParams = [
        'cover' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'square' => [
                [
                    'name' => 'square',
                    'ratio' => 1,
                ],
            ],
        ],
    ];

    // public $casts = [
    //     'publish_start_date'    => 'datetime',
    //     'publish_end_date'      => 'datetime',
    // ];

    protected static function booted(): void
    {
        $now = now('UTC');

        // custom global published scope
        if (!routeName('twill') || request()->isPreview) {
            static::addGlobalScope('published', function (Builder $query) use ($now) {
                $query->where('published', 1)
                    ->whereTranslation('active', 1, locale())
                    ->where('publish_start_date', '<=', $now);
            });
        }
    }


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
    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }


    /**
     * Scopes
     */
    public function scopeFeatured(Builder $query, $featured = true): void
    {
        $query->where('featured', $featured);
    }

    public function scopeOrder(Builder $query, $order = 'DESC'): void
    {
        $query->orderBy('publish_start_date', $order);
    }
}
