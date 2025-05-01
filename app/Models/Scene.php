<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'type',
        'content',
        'choice_1_text',
        'choice_1_target_scene_id',
        'choice_2_text',
        'choice_2_target_scene_id',
    ];

    // Сцена принадлежит одной истории
    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    // Первый выбор ведёт к другой сцене
    public function choice1Target()
    {
        return $this->belongsTo(Scene::class, 'choice_1_target_scene_id');
    }

    // Второй выбор ведёт к другой сцене
    public function choice2Target()
    {
        return $this->belongsTo(Scene::class, 'choice_2_target_scene_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
