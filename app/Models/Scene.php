<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'content',

        'chapter_key', // Глава
        'branch',      // Ветка
        'number',      // Номер внутри ветки

        'choice_1_text',
        'choice_1_target_code',
        'choice_2_text',
        'choice_2_target_code',
    ];

    // Сцена принадлежит одной истории
    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    // Поиск следующей сцены по коду
    public static function findByCode(string $code, int $story_id): ?self
    {
        [$chapter_key, $branch, $number] = explode(':', $code);

        return self::where('story_id', $story_id)
            ->where('chapter_key', $chapter_key)
            ->where('branch', $branch)
            ->where('number', $number)
            ->first();
    }

    // Список всех возможных переходов (максимум два)
    public function nextScenes()
    {
        return collect([
            $this->choice_1_target_code
                ? self::findByCode($this->choice_1_target_code, $this->story_id)
                : null,
            $this->choice_2_target_code
                ? self::findByCode($this->choice_2_target_code, $this->story_id)
                : null,
        ])->filter();
    }
}
