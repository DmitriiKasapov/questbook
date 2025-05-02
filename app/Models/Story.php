<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'genre',
        'is_published',
        'cover_image',
    ];

    // Все сцены истории
    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }

    // Ветки истории
    public function branches()
    {
        return $this->hasMany(\App\Models\Branch::class);
    }

    // Главы истории
    public function chapters()
    {
        return $this->hasMany(\App\Models\Chapter::class);
    }

    // Первая сцена истории — vvod:main:1
    public function getFirstScene()
    {
        return $this->scenes()
            ->where('chapter_key', 'vvod')
            ->where('branch', 'main')
            ->where('number', 1)
            ->first();
    }

    // Получить URL обложки
    public function getCoverUrlAttribute()
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : null;
    }
}
