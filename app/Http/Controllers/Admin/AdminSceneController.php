<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scene;
use App\Models\Story;
use Illuminate\Http\Request;

class AdminSceneController extends Controller
{
    // Список всех сцен
    public function index(Request $request)
    {
        $scenes = Scene::with('story')->orderBy('id')->get();
        return view('admin.scenes.index', compact('scenes'));
    }

    // Форма создания новой сцены
    public function create(Request $request)
    {
        $storyId = $request->get('story_id');
        $branchId = $request->get('branch_id');

        $story = $storyId ? \App\Models\Story::with('branches')->findOrFail($storyId) : null;
        $branch = $branchId ? \App\Models\Branch::findOrFail($branchId) : null;

        $chapterKey = $branch?->chapter_key;

        return view('admin.scenes.create', compact('story', 'branch', 'chapterKey'));
    }
    // Сохранение новой сцены
    public function store(Request $request)
    {
        $validated = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'chapter_key' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'number' => 'required|integer',
            'content' => 'required|string',

            'choice_1_text' => 'nullable|string|max:255',
            'choice_1_target_code' => 'nullable|string|max:255',
            'choice_2_text' => 'nullable|string|max:255',
            'choice_2_target_code' => 'nullable|string|max:255',
        ]);

        Scene::create($validated);

        return redirect()
            ->to(route('admin.stories.edit', $validated['story_id']) . '#branches')
            ->with('success', 'Сцена добавлена.');
    }

    // Форма редактирования сцены
    public function edit(Scene $scene)
    {
        $story = $scene->story()->with('branches')->first();
        $stories = Story::all();

        return view('admin.scenes.edit', compact('scene', 'story', 'stories'));
    }

    // Обновление сцены
    public function update(Request $request, Scene $scene)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'chapter_key' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'number' => 'required|integer',
            'content' => 'required|string',

            'choice_1_text' => 'nullable|string|max:255',
            'choice_1_target_code' => 'nullable|string|max:255',
            'choice_2_text' => 'nullable|string|max:255',
            'choice_2_target_code' => 'nullable|string|max:255',
        ]);

        $scene->update($data);

        return redirect()
            ->to(route('admin.stories.edit', $data['story_id']) . '#branches')
            ->with('success', 'Сцена обновлена.');
    }

    // Удаление сцены
    public function destroy(Scene $scene)
    {
        $scene->delete();

        return redirect()
            ->route('admin.scenes.index')
            ->with('success', 'Сцена удалена!');
    }
}
