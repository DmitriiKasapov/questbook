<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Scene;

class ReadStoryController extends Controller
{
    public function show(Story $story, Scene $scene = null)
    {
        if ($scene && $scene->story_id !== $story->id) {
            abort(404);
        }

        $chapter = $scene
            ? $scene->chapter
            : $story->chapters()->orderBy('position')->first();

        $scene = $scene
            ?? $chapter?->scenes()->orderBy('id')->first();

        return view('story.read', compact('story', 'chapter', 'scene'));
    }
}
