<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description', // ← ДОЛЖНО БЫТЬ ЗДЕСЬ
        'description',
        'genre',
        'is_published',
        'cover_image',
    ];

    // История имеет много сцен
    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
    public function firstScene()
    {
        return $this->scenes()
            ->where('type', 'main')
            ->orderBy('id')
            ->first();
    }
    public function getCoverUrlAttribute()
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : null;
    }
    public function branches()
    {
        return $this->hasMany(\App\Models\Branch::class);
    }
}
