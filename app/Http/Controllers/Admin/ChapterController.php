<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'music' => 'nullable|mimes:mp3,wav,ogg|max:10240',
            'position' => 'nullable|integer',
        ]);

        // Генерация ключа: glava1, glava2 и т.д.
        $count = \App\Models\Chapter::where('story_id', $data['story_id'])->count();
        $data['key'] = 'glava' . ($count + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chapters/images', 'public');
        }

        if ($request->hasFile('music')) {
            $data['music'] = $request->file('music')->store('chapters/music', 'public');
        }

        $chapter = \App\Models\Chapter::create($data);

        return redirect()
            ->to(route('admin.stories.edit', $data['story_id']) . '#chapters?chapter=' . $chapter->key)
            ->with('success', 'Глава успешно добавлена.');
    }

    public function update(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'position' => 'nullable|integer',
        ]);

        $chapter->update($data);

        return back()->with('success', 'Глава обновлена.');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()
        ->to(route('admin.stories.edit', $chapter->story_id) . '#chapters')
        ->with('success', 'Глава удалена.');
    }
}
