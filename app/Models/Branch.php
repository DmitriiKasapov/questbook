<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['story_id', 'title', 'type'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
