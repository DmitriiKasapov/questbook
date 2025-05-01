<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStoryController extends Controller
{
    public function index()
    {
        $stories = Story::orderBy('id')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'branch_id' => 'required|exists:branches,id',
            'type' => 'required|in:main,branch,ending',
            'content' => 'required|string',
            'choice_1_text' => 'nullable|string|max:255',
            'choice_1_target_scene_id' => 'nullable|integer|exists:scenes,id',
            'choice_2_text' => 'nullable|string|max:255',
            'choice_2_target_scene_id' => 'nullable|integer|exists:scenes,id',
        ]);

        \App\Models\Scene::create([
            'story_id' => $validated['story_id'],
            'branch_id' => $validated['branch_id'],
            'type' => $validated['type'],
            'content' => $validated['content'],
            'choice_1_text' => $validated['choice_1_text'],
            'choice_1_target_scene_id' => $validated['choice_1_target_scene_id'],
            'choice_2_text' => $validated['choice_2_text'],
            'choice_2_target_scene_id' => $validated['choice_2_target_scene_id'],
        ]);

        return redirect()
            ->to(route('admin.stories.edit', $validated['story_id']) . '#branches')
            ->with('success', 'Сцена добавлена.');
    }

    public function edit(\App\Models\Story $story)
    {
        $story->load(['branches.scenes']);

        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, Story $story)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255', // ← ЭТО ОБЯЗАТЕЛЬНО
            'description' => 'nullable|string',
            'genre' => 'nullable|string',
            'is_published' => 'boolean',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data['is_published'] = $request->has('is_published');

        // Удаление старой обложки по чекбоксу
        if ($request->has('delete_cover') && $story->cover_image) {
            if (Storage::disk('public')->exists($story->cover_image)) {
                Storage::disk('public')->delete($story->cover_image);
            }
            $data['cover_image'] = null;
        }

        // Загрузка новой обложки (и удаление старой)
        if ($request->hasFile('cover_image')) {
            if ($story->cover_image && Storage::disk('public')->exists($story->cover_image)) {
                Storage::disk('public')->delete($story->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        $story->update($data);

        return redirect()->route('admin.stories.edit', $story)->with('success', 'Изменения сохранены');
    }

    public function destroy(Story $story)
    {
        // Удалить обложку, если есть
        if ($story->cover_image && Storage::disk('public')->exists($story->cover_image)) {
            Storage::disk('public')->delete($story->cover_image);
        }

        $story->delete();

        return redirect()->route('admin.panel')->with('success', 'История удалена');
    }
}
