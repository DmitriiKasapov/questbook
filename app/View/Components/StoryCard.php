<?php

namespace App\View\Components;

use App\Models\Story;
use Illuminate\View\Component;

class StoryCard extends Component
{
    public Story $story;

    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    public function render()
    {
        return view('components.cards.story-card');
    }
}
